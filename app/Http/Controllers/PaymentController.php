<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Order;
use App\Enums\PaymentMethodEnum;
use App\Enums\PaymentStatusEnum;
use App\Enums\OrderStatusEnum;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with(['order.user'])->get();
        return view('admin.payments.index', compact('payments'));
    }

    public function create()
    {
        $orders = Order::with('user')
            ->whereDoesntHave('payment')
            ->where('status', '!=', OrderStatusEnum::Cancelled->value)
            ->get();
            
        $paymentMethods = enum_labels(PaymentMethodEnum::class);
        $paymentStatuses = enum_labels(PaymentStatusEnum::class);
        
        return view('admin.payments.create', compact('orders', 'paymentMethods', 'paymentStatuses'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'order_id' => 'required|exists:orders,id|unique:payments,order_id',
            'payment_method' => 'required|in:'.implode(',', enum_values(PaymentMethodEnum::class)),
            'transaction_code' => 'nullable|string|max:255|unique:payments,transaction_code',
            'status' => 'required|in:'.implode(',', enum_values(PaymentStatusEnum::class)),
        ]);

        Payment::create($validated);

        return redirect()->route('admin.payments.index')
            ->with('success', 'Payment created successfully!');
    }

    public function show(Payment $payment)
    {
        $payment->load(['order.user', 'order.orderItems.product']);
        return view('admin.payments.show', compact('payment'));
    }

    public function edit(Payment $payment)
    {
        $payment->load(['order.user']);
        $paymentMethods = enum_labels(PaymentMethodEnum::class);
        $paymentStatuses = enum_labels(PaymentStatusEnum::class);
        
        return view('admin.payments.edit', compact('payment', 'paymentMethods', 'paymentStatuses'));
    }

    public function update(Request $request, Payment $payment)
    {
        $validated = $request->validate([
            'payment_method' => 'required|in:'.implode(',', enum_values(PaymentMethodEnum::class)),
            'transaction_code' => 'nullable|string|max:255',
            'status' => 'required|in:'.implode(',', enum_values(PaymentStatusEnum::class)),
        ]);

        $payment->update($validated);

        return redirect()->route('admin.payments.index')
            ->with('success', 'Payment updated successfully!');
    }

    public function destroy(Payment $payment)
    {
        $payment->delete();

        return redirect()->route('admin.payments.index')
            ->with('success', 'Payment deleted successfully!');
    }
}