<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the user's payments
     */
    public function index(Request $request)
    {
        // Users can only view their own payments
        $query = Payment::query()
            ->whereHas('order', function ($q) {
                $q->where('user_id', auth()->id());
            })
            ->with(['order']);

        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        $payments = $query->latest()->paginate(10);
        
        return view('user.payments.index', compact('payments'));
    }

    /**
     * Display the specified payment
     */
    public function show(Payment $payment)
    {
        // Authorize: user can only view payments for their own orders
        if ($payment->order->user_id !== auth()->id()) {
            abort(403, 'Unauthorized access to payment.');
        }

        $payment->load(['order.orderItems.product']);
        return view('user.payments.show', compact('payment'));
    }
}
