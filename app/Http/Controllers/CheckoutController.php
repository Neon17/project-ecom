<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatusEnum;
use App\Enums\PaymentMethodEnum;
use App\Enums\PaymentStatusEnum;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Coupon;
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

        $discountAmount = 0;
        if (session()->has('coupon_code')) {
            $coupon = Coupon::where('code', session('coupon_code'))->first();
            if ($coupon && $coupon->isValid()) {
                $subtotal = $cart->cartItems->sum(fn($item) => $item->product->price * $item->quantity);
                $subtotalPaisa = (int)($subtotal * 100);
                if ($coupon->canBeUsed($subtotalPaisa)) {
                    $discountPaisa = $coupon->calculateDiscount($subtotalPaisa);
                    $discountAmount = $discountPaisa / 100;
                }
            }
        }

        return view('user.orders.place', compact('cart', 'addresses', 'discountAmount'));
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
            // Lock the products to prevent race conditions (e.g. stock changes)
            // Although we aren't decrementing stock here yet, this is the requested "locking" logic.
            // We fetch the products involved in the cart to lock their rows.
            $productIds = $cart->cartItems->pluck('product_id');
            // We don't strictly need the result, just the lock.
            // But usually you'd check stock here.
            Product::whereIn('id', $productIds)->lockForUpdate()->get();

            // Calculate charges
            // product->price is float (NPR)
            $subtotal = $cart->cartItems->sum(fn($item) => $item->product->price * $item->quantity);
            
            $discountAmount = 0;
            $couponId = null;
            
            if (session()->has('coupon_code')) {
                $coupon = Coupon::where('code', session('coupon_code'))->first();
                if ($coupon && $coupon->isValid()) {
                    // Calculate discount in paisa
                    $subtotalPaisa = (int)($subtotal * 100);
                    if ($coupon->canBeUsed($subtotalPaisa)) {
                        $discountPaisa = $coupon->calculateDiscount($subtotalPaisa);
                        $discountAmount = $discountPaisa / 100; // Convert back to NPR
                        $couponId = $coupon->id;
                        
                        // Increment usage
                        $coupon->incrementUsage();
                    }
                }
            }

            // Tax 10% of (subtotal - discount)
            $taxableAmount = max(0, $subtotal - $discountAmount);
            $taxAmount = $taxableAmount * 0.10; 
            
            $serviceCharge = 0;
            $deliveryCharge = 0;
            $totalAmount = $taxableAmount + $taxAmount + $serviceCharge + $deliveryCharge;

            $order = Order::create([
                'user_id' => $request->user()->id,
                'status' => OrderStatusEnum::Pending->value,
                'tax_amount' => $taxAmount,
                'service_charge' => $serviceCharge,
                'delivery_charge' => $deliveryCharge,
                'total_amount' => $totalAmount,
                'coupon_id' => $couponId,
                'discount_amount' => $discountAmount, // Mutator handles conversion to paisa
            ]);

            $order->snapshotAddress($address);
            
            // Clear session
            session()->forget('coupon_code');

            foreach ($cart->cartItems as $cartItem) {
                $order->orderItems()->create([
                    'product_id' => $cartItem->product_id,
                    'quantity' => $cartItem->quantity,
                    // product->price is already divided by 100 via accessor, but we need to store it as float?
                    // Wait, OrderItem amount_per_item also has an accessor that multiplies by 100 on set.
                    // So if we pass the float value (e.g. 200.00), the mutator will store 20000.
                    // $cartItem->product->price returns float (200.00).
                    // So passing it directly is correct.
                    'amount_per_item' => $cartItem->product->price,
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
        $order->load(['user', 'orderItems.product', 'payment']);
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

        return redirect()->route('user.orders.index')->with('success', 'Payment method selected.');
    }

    public function payOrderViaEsewa(Request $request, Order $order)
    {
        $order->load(['payment', 'orderItems', 'user']);

        if (!$order->payment) {
            $order->payment()->create([
                'payment_method' => PaymentMethodEnum::Esewa->value,
                'status' => 'pending',
            ]);
        }

        $order->fresh(['payment', 'orderItems', 'user']);
        $payment = $order->payment;

        $payment->update([
            'payment_method' => PaymentMethodEnum::Esewa->value,
            'status' => 'pending',
        ]);

        $amount = $order->orderItems->sum(function ($item) {
            return $item->amount_per_item * $item->quantity;
        });

        // Use stored charges from order
        $tax_amount = $order->tax_amount;
        $product_service_charge = $order->service_charge;
        $product_delivery_charge = $order->delivery_charge;
        $total_amount = $order->total_amount;

        // Fallback if total_amount is not set (legacy orders)
        if ($total_amount === null) {
             // Calculate 10% tax on amount
             $tax_amount = $amount * 0.10;
             $product_service_charge = 0;
             $product_delivery_charge = 0;
             $total_amount = $amount + $tax_amount + $product_service_charge + $product_delivery_charge;
        }

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

        $order->fresh(['payment', 'orderItems', 'user']);

        if (!$order->payment) {
            $order->payment()->create([
                'payment_method' => PaymentMethodEnum::Khalti->value,
                'status' => 'pending',
            ]);
        }

        $order->fresh(['payment', 'orderItems', 'user']);
        $payment = $order->payment;

        $payment->update([
            'payment_method' => PaymentMethodEnum::Khalti->value,
            'status' => 'pending',
        ]);

        $amount = $order->total_amount;
        
        // Fallback for legacy orders
        if (!$amount) {
             $subtotal = $order->orderItems->sum(function ($item) {
                return $item->amount_per_item * $item->quantity;
            });
            $amount = $subtotal; // Khalti usually takes total amount
        }

        // Khalti expects amount in paisa (multiply by 100)
        // Our amount is already float (e.g. 200.00), so multiply by 100 -> 20000
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
        return null;
    }

    public function applyCoupon(Request $request)
    {
        $request->validate([
            'code' => 'required|string'
        ]);

        $code = strtoupper($request->code);
        $coupon = Coupon::where('code', $code)->first();

        if (!$coupon) {
            return back()->with('error', 'Invalid coupon code.');
        }

        $cart = $request->user()->cart()->with(['cartItems.product'])->first();
        if (!$cart) {
            return back()->with('error', 'Cart is empty.');
        }

        $subtotal = $cart->cartItems->sum(fn($item) => $item->product->price * $item->quantity);
        // Convert subtotal to paisa for validation
        $subtotalPaisa = (int)($subtotal * 100);

        if (!$coupon->isValid()) {
            return back()->with('error', 'Coupon is invalid or expired.');
        }

        if (!$coupon->canBeUsed($subtotalPaisa)) {
            return back()->with('error', 'Minimum purchase requirement not met.');
        }

        session()->put('coupon_code', $code);

        return back()->with('success', 'Coupon applied successfully!');
    }

    public function removeCoupon()
    {
        session()->forget('coupon_code');
        return back()->with('success', 'Coupon removed.');
    }
}
