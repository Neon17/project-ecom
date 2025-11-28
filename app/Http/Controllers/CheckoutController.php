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
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\error;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        $cart = $request->user()->cart()->with(['cartItems.product', 'user'])->first();
        if (!$cart || $cart->cartItems->isEmpty()) {
            return redirect()->route('user.cart.index')->with('error', 'Your cart is empty.');
        }
        return view('user.orders.place', compact('cart'));
    }

    public function viewCheckout(Request $request)
    {
        $cart = $request->user()->cart()->with(['cartItems.product', 'user'])->first();
        $addresses = $request->user()->addresses()->get();
        if (!$cart || $cart->cartItems->isEmpty()) {
            return redirect()->route('user.cart.index')->with('error', 'Your cart is empty.');
        }
        return view('user.orders.place', compact('cart', 'addresses'));
    }

    public function checkout(Request $request, Cart $cart)
    {
        $validated = $request->validate([
            'address_id' => 'nullable|exists:addresses,id',
            'address' => 'required_unless:address_id,exists|array',
            'address.country' => 'required|string',
            'address.state' => 'required|string',
            'address.city' => 'required|string',
            'address.street_address_1' => 'required|string',
            'address.street_address_2' => 'nullable|string',
        ]);

        $cart = $cart->with(['cartItems', 'user'])->first();

        if ($validated['address_id']) {
            $address = $request->user()->addresses()->find($validated['address_id']);
        } else {
            $address = $request->user()->addresses()->create($validated['address']);
        }

        $order = DB::transaction(function () use ($request, $address, $cart) {
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

            return $order;
        });

        return redirect()->route('orders.pay', $order->id)->with('success', 'Order placed successfully. Please proceed to payment.');
    }

    public function showPaymentPage(Request $request, Order $order)
    {
        $order->load(['user', 'address', 'orderItems.product', 'payment']);
        return view('user.orders.pay', compact('order'));
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

        return redirect()->route('user.orders.index')->with('success', 'Payment method selected.');
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
        $total_amount = $amount + $tax_amount + $product_service_charge + $product_delivery_charge;

        $transaction_uuid = (string) time();

        $success_url = route('payment.success', $payment->id);
        $failure_url = route('payment.failure', $payment->id);

        $secret_key = env('ESEWA_SECRET_KEY', '8gBm/:&EnhH.1/q');
        $product_code = env('ESEWA_PRODUCT_CODE', 'EPAYTEST');
        $production = env('ESEWA_PRODUCTION', false);

        $data = 'total_amount=' . $total_amount . ',transaction_uuid=' . $transaction_uuid . ',product_code=' . $product_code;
        $signature = hash_hmac('sha256', $data, $secret_key, true);
        $signature = base64_encode($signature);
        $signed_field_names = "total_amount,transaction_uuid,product_code";

        $payment->update([
            'transaction_code' => $transaction_uuid,
            'total_amount' => $total_amount,
        ]);

        $payment->save();

        $esewa_url = 'https://rc-epay.esewa.com.np/api/epay/main/v2/form';

        $postData = [
            'amount' => $amount,
            'tax_amount' => $tax_amount,
            'total_amount' => $total_amount,
            'transaction_uuid' => $transaction_uuid,
            'product_code' => $product_code,
            'product_service_charge' => $product_service_charge,
            'product_delivery_charge' => $product_delivery_charge,
            'success_url' => $success_url,
            'failure_url' => $failure_url,
            'signed_field_names' => $signed_field_names,
            'signature' => $signature,
        ];

        return view('user.orders.esewa-payment-form', compact('esewa_url', 'postData'));
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
            "return_url" => route('payment.success', $payment->id), // Use unified success URL
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
            return redirect($data['payment_url']);
        }

        return redirect()->back()->with('error', 'Khalti payment initiation failed: ' . $response->body());
    }

    public function successUrl(Request $request, Payment $payment)
    {
        $responseData = $this->decodePaymentResponse($request);

        $payment->update([
            'status' => PaymentStatusEnum::Completed,
            'transaction_code' => $this->extractTransactionCode($responseData),
            'payment_response' => json_encode($responseData),
            'paid_at' => now(),
        ]);

        return redirect()->route('user.orders.index')->with('success', 'Payment successful!');
    }

    public function failureUrl(Request $request, Payment $payment)
    {
        $responseData = $this->decodePaymentResponse($request);

        $payment->update([
            'status' => PaymentStatusEnum::Failed,
            'transaction_code' => $this->extractTransactionCode($responseData),
            'payment_response' => json_encode($responseData),
            'failed_at' => now(),
        ]);

        return redirect()->route('user.orders.index')->with('error', 'Payment failed!');
    }

    /**
     * Decode payment response for eSewa and Khalti
     */
    protected function decodePaymentResponse(Request $request): array
    {
        $data = [];

        // eSewa response format (data parameter as base64 encoded JSON)
        if ($request->has('data')) {
            $jsonString = base64_decode($request->input('data'));
            $data = json_decode($jsonString, true) ?? [];
        }

        // Khalti response format (direct JSON parameters)
        elseif ($request->has('pidx')) {
            $data = $request->all();
        }

        // General fallback
        else {
            $data = $request->all();
        }

        return $data;
    }

    /**
     * Extract transaction code from eSewa and Khalti responses
     */
    protected function extractTransactionCode(array $responseData): ?string
    {
        // eSewa transaction codes
        if (isset($responseData['transaction_code'])) {
            return $responseData['transaction_code'];
        }
        if (isset($responseData['ref_id'])) {
            return $responseData['ref_id'];
        }
        if (isset($responseData['tid'])) {
            return $responseData['tid'];
        }
        if (isset($responseData['purchase_order_id'])) {
            return $responseData['purchase_order_id'];
        }

        // Khalti transaction codes
        if (isset($responseData['pidx'])) {
            return $responseData['pidx'];
        }
        if (isset($responseData['transaction_id'])) {
            return $responseData['transaction_id'];
        }

        return null;
    }
}
