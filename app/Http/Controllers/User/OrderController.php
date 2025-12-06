<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = auth()->user()->orders()->with(['orderItems.product', 'payment']);

        if ($request->has('search') && $request->search) {
            $query->where('id', 'like', '%' . $request->search . '%');
        }

        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        $orders = $query->latest()->paginate(10);
        return view('user.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        // Ensure the order belongs to the user
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }
        $order->load(['orderItems.product', 'payment']);
        return view('user.orders.show', compact('order'));
    }
}
