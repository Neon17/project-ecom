<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatusEnum;
use App\Models\Address;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::query()->with('user', 'address')->get();
        return view('admin.orders.index', compact('orders'));
    }

  
    public function create()
    {
        $users = User::query()->get();
        $products = Product::query()->get();
        return view('admin.orders.create', compact('users', 'products'));
    }

    public function checkout(Request $request)
    {
        
    }

    public function adminStore(Request $request)
    {
        info($request->all());
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'status' => 'required|in:'.implode(',', enum_values(OrderStatusEnum::class)),
            'address' => 'required|array',
            'address.*' => 'required|string',
            'address.country' => 'required|string',
            'address.state' => 'required|string',
            'address.city' => 'required|string',
            'address.street_address_1' => 'required|string',
            'address.street_address_2' => 'nullable|string',

            'products' => 'required|array',
            'products.*' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
            'products.*.amount_per_item' => 'required|numeric|min:0',
        ]);

        // all products will be stored in OrderItems table
        // user_id, status and address will be stored in Orders table

        $address = Address::create($validated['address']);

        $order = Order::create([
            'user_id' => $validated['user_id'],
            'status' => $validated['status'],
            'address_id' => $address->id,
        ]);

        foreach ($validated['products'] as $product) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product['id'],
                'quantity' => $product['quantity'],
                'price' => $product['price'],
            ]);
        }

        return redirect()->route('admin.orders.index');
    }

    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
