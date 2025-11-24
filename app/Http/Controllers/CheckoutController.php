<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatusEnum;
use App\Enums\PaymentMethodEnum;
use App\Enums\PaymentStatusEnum;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Xentixar\EsewaSdk\Esewa;

use function Laravel\Prompts\error;

class CheckoutController extends Controller
{
    public function viewCheckout(Request $request)
    {
        // here we can checkout the order from the cart
        // for that we have to get the cart from user
        // every data is same as cart, we have to add address, payment method

        $cart = $request->user()->cart()->with(['cartItems.product', 'user'])->first();
        if (!$cart || $cart->cartItems->isEmpty()) {
            return redirect()->route('carts.index')->with('error', 'Your cart is empty.');
        }
        return view('users.orders.place', compact('cart'));
    }

    public function checkout(Request $request, Cart $cart)
    {
        $validated = $request->validate([
            'address' => 'required|array',
            'address.country' => 'required|string',
            'address.state' => 'required|string',
            'address.city' => 'required|string',
            'address.street_address_1' => 'required|string',
            'address.street_address_2' => 'nullable|string',
        ]);

        $cart = $cart->with(['cartItems', 'user'])->first();

        // Check if user already has this address or create new one
        // For simplicity, we'll create a new one or you could search for existing
        $address = request()->user()->addresses()->create($validated['address']);

        $order = Order::create([
            'user_id' => $request->user()->id,
            'address_id' => $address->id,
            'status' => OrderStatusEnum::Pending->value,
        ]);

        foreach ($cart->cartItems as $cartItem) {
            $order->orderItems()->create([
                'product_id' => $cartItem->product_id,
                'quantity' => $cartItem->quantity,
                'amount_per_item' => $cartItem->amount_per_item || $cartItem->product->price,
            ]);
        }

        $cart->cartItems()->delete();
        $cart->delete();

        return redirect()->route('orders.pay', $order->id)->with('success', 'Order placed successfully. Please proceed to payment.');
    }

    public function showPaymentPage(Request $request, Order $order)
    {
        $order->load(['user', 'address', 'orderItems.product', 'payment']);
        return view('users.orders.pay', compact('order'));
    }

    public function processPayment(Request $request, Order $order)
    {
        // add payment, users select payment method here
        $validated = $request->validate([
            'payment_method' => 'required|in:' . implode(',', enum_values(PaymentMethodEnum::class)),
        ]);

        // Check if payment already exists
        if ($order->payment) {
            $order->payment()->update([
                'payment_method' => $validated['payment_method'],
                'status' => 'pending',
            ]);
        } else {
            $order->payment()->create([
                'payment_method' => $validated['payment_method'],
                'status' => 'pending',
            ]);
        }

        $order->save();
        $order->fresh();

        if ($validated['payment_method'] === PaymentMethodEnum::Esewa->value) {
            return $this->payOrderViaEsewa($request, $order);
        }

        if ($validated['payment_method'] === PaymentMethodEnum::Khalti->value) {
            return $this->payOrderViaKhalti($request, $order);
        }

        // Handle other payment methods or default success for COD (if applicable)
        // For now, redirect to success if not Esewa (or handle accordingly)

        return redirect()->route('orders.index')->with('success', 'Payment method selected.');
    }

    public function payOrderViaEsewa(Request $request, Order $order)
    {
        $order->load(['payment', 'orderItems', 'user', 'address']);

        if (!$order->payment) {
            $order->payment()->create([
                'payment_method' => PaymentMethodEnum::Esewa->value,
                'status' => 'pending',
            ]);
        }

        $order->fresh(['payment', 'orderItems', 'user', 'address']);
        $payment = $order->payment;

        $payment->update([
            'payment_method' => PaymentMethodEnum::Esewa->value,
            'status' => 'pending',
        ]);

        $amount = $order->orderItems->sum(function ($item) {
            return $item->amount_per_item * $item->quantity;
        });

        $tax_amount = 10;
        $product_service_charge = 0;
        $product_delivery_charge = 0;
        $total_amount = $amount + $tax_amount;

        $transaction_uuid = time();

        $success_url = route('payment.success', $payment->id);
        $failure_url = route('payment.failure', $payment->id);

        $payment->update([
            'transaction_id' => $transaction_uuid,
            'total_amount' => $total_amount,
        ]);

        $esewa = new Esewa();
        $esewa->config($success_url, $failure_url, (float)$total_amount, $transaction_uuid);
        $esewa->init();

        return view('users.orders.pay', compact('order'));
    }

    public function payOrderViaKhalti(Request $request, Order $order)
    {
        $secretKey = env('KHALTI_SECRET_KEY');
        if (!$secretKey) {
            return redirect()->back()->with('error', 'Khalti Secret Key is missing in .env');
        }

        $order->fresh(['payment', 'orderItems', 'user', 'address']);

        if (!$order->payment) {
            $order->payment()->create([
                'payment_method' => PaymentMethodEnum::Khalti->value,
                'status' => 'pending',
            ]);
        }
        $order->fresh(['payment', 'orderItems', 'user', 'address']);
        $payment = $order->payment;

        $payment->update([
            'payment_method' => PaymentMethodEnum::Khalti->value,
            'status' => 'pending',
        ]);

        $amount = $order->orderItems->sum(function ($item) {
            return $item->amount_per_item * $item->quantity;
        });

        // Khalti expects amount in paisa (multiply by 100)
        $amountInPaisa = $amount * 100;

        $payload = [
            "return_url" => route('payment.khalti.callback'),
            "website_url" => config('app.url'),
            "amount" => $amountInPaisa,
            "purchase_order_id" => (string) $order->id,
            "purchase_order_name" => "Order #" . $order->id,
            "customer_info" => [
                "name" => $order->user->name,
                "email" => $order->user->email,
                "phone" => "9800000000" // Should ideally come from user profile or address
            ]
        ];

        $response = Http::withHeaders([
            'Authorization' => 'Key ' . $secretKey,
            'Content-Type' => 'application/json',
        ])->post('https://dev.khalti.com/api/v2/epayment/initiate/', $payload);

        if ($response->successful()) {
            $data = $response->json();
            // Store pidx if needed, for now just redirect
            return redirect($data['payment_url']);
        }

        return redirect()->back()->with('error', 'Khalti payment initiation failed: ' . $response->body());
    }

    public function khaltiCallback(Request $request)
    {
        $secretKey = env('KHALTI_SECRET_KEY');
        if (!$secretKey) {
            return redirect()->route('orders.index')->with('error', 'Khalti Secret Key is missing in .env');
        }

        $pidx = $request->input('pidx');
        $status = $request->input('status');
        $purchase_order_id = $request->input('purchase_order_id');

        if (!$pidx) {
            return redirect()->route('orders.index')->with('error', 'Invalid payment callback.');
        }

        // Verify with Lookup API
        $response = Http::withHeaders([
            'Authorization' => 'Key ' . $secretKey,
            'Content-Type' => 'application/json',
        ])->post('https://dev.khalti.com/api/v2/epayment/lookup/', [
            'pidx' => $pidx
        ]);

        if ($response->successful()) {
            $data = $response->json();

            if ($data['status'] === 'Completed') {
                $order = Order::find($purchase_order_id);
                if ($order && $order->payment) {
                    $order->payment->update([
                        'status' => 'success',
                        'transaction_code' => $data['transaction_id'] ?? $pidx,
                    ]);
                    return redirect()->route('orders.index')->with('success', 'Payment successful via Khalti!');
                }
            }
        }

        return redirect()->route('orders.index')->with('error', 'Payment verification failed or cancelled.');
    }

    public function successUrl(Request $request, Payment $payment)
    {
        $esewa = new Esewa($request->all());
        $responseData = $esewa->decode();
        $payment->update([
            'status' => PaymentStatusEnum::Completed,
            'transaction_code' => $responseData['tid']
                ?? $responseData['transaction_code']
                ?? $responseData['ref_id']
                ?? $responseData['purchase_order_id']
                ?? null,
        ]);

        return redirect()->route('orders.index')->with('success', 'Payment successful!');
    }

    public function failureUrl(Request $request, Payment $payment)
    {
        $esewa = new Esewa($request->all());
        $responseData = $esewa->decode();
        $payment->update([
            'status' => PaymentStatusEnum::Failed,
            'transaction_code' => $responseData['tid']
                ?? $responseData['transaction_code']
                ?? $responseData['ref_id']
                ?? $responseData['purchase_order_id']
                ?? null,
        ]);

        return redirect()->route('orders.index')->with('error', 'Payment failed!');
    }
}
