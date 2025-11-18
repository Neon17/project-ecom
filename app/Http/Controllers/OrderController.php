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
        $orders = Order::query()->with('user', 'address', 'payment')->get();
        return view('admin.orders.index', compact('orders'));
    }


    public function create()
    {
        $users = User::query()->get();
        $products = Product::query()->get();
        return view('admin.orders.create', compact('users', 'products'));
    }

    public function checkout(Request $request) {}

    public function adminStore(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'status' => 'required|in:' . implode(',', enum_values(OrderStatusEnum::class)),
            'address' => 'required|array',
            'address.*' => 'required|string',
            'address.country' => 'required|string',
            'address.state' => 'required|string',
            'address.city' => 'required|string',
            'address.street_address_1' => 'required|string',
            'address.street_address_2' => 'nullable|string',

            'products' => 'required|array',
            'products.*.id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
            'products.*.amount_per_item' => 'required|numeric|min:0',
        ]);

        // all products will be stored in OrderItems table
        // user_id, status and address will be stored in Orders table

        $address = Address::create([
            'user_id' => $validated['user_id'],
            'country' => $validated['address']['country'],
            'state' => $validated['address']['state'],
            'city' => $validated['address']['city'],
            'street_address_1' => $validated['address']['street_address_1'],
            'street_address_2' => $validated['address']['street_address_2'],
        ]);

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
                'amount_per_item' => $product['amount_per_item'],
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
    public function show(User $user, Order $order)
    {
        $order->load(['user', 'address', 'orderItems.product']);
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user, Order $order)
    {
        $order->load(['user', 'address', 'orderItems.product']);
        return view('admin.orders.edit', compact('order'));
    }

    public function update(Request $request, string $userId, string $orderId)
    {
        $order = Order::findOrFail($orderId);
        $validated = $request->validate([
            'status' => 'required|in:' . implode(',', enum_values(OrderStatusEnum::class)),
            'address' => 'required|array',
            'address.country' => 'required|string',
            'address.state' => 'required|string',
            'address.city' => 'required|string',
            'address.street_address_1' => 'required|string',
            'address.street_address_2' => 'nullable|string',
            'items' => 'required|array',
            'items.*.id' => 'required|exists:order_items,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.amount_per_item' => 'required|numeric|min:0',
        ]);

        $order->update([
            'status' => $validated['status']
        ]);

        $order->address->update($validated['address']);

        foreach ($validated['items'] as $itemData) {
            $amountInCents = (int)($itemData['amount_per_item'] * 100);

            OrderItem::where('id', $itemData['id'])->update([
                'quantity' => $itemData['quantity'],
                'amount_per_item' => $amountInCents,
            ]);
        }

        return redirect()->route('users.orders.show', [$userId, $orderId])
            ->with('success', 'Order updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $userId, string $orderId)
    {
        $order = Order::findOrFail($orderId);
        $order->load('orderItems');
        $orderItems = $order->orderItems;
        foreach ($orderItems as $orderItem) {
            $orderItem->delete();
        }
        $order->delete();
        return redirect()->back()->with('success', 'Order deleted successfully');
    }
}
