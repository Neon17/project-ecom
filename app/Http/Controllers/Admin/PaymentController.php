<?php

namespace App\Http\Controllers\Admin;

use App\Enums\PaymentMethodEnum;
use App\Enums\PaymentStatusEnum;
use App\Enums\OrderStatusEnum;
use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Order;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $query = Payment::query()->with(['order.user']);

        if ($request->has('search') && $request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('transaction_code', 'like', '%' . $request->search . '%')
                  ->orWhereHas('order.user', function ($u) use ($request) {
                      $u->where('name', 'like', '%' . $request->search . '%')
                        ->orWhere('email', 'like', '%' . $request->search . '%');
                  });
            });
        }

        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        if ($request->has('payment_method') && $request->payment_method) {
            $query->where('payment_method', $request->payment_method);
        }

        $payments = $query->latest()->paginate(10);
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