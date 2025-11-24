<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = auth()->user()->orders()->with(['orderItems.product', 'payment'])->latest()->paginate(10);
        return view('user.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        // Ensure the order belongs to the user
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }
        $order->load(['orderItems.product', 'address', 'payment']);
        return view('user.orders.show', compact('order'));
    }
}
