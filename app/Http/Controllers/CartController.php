<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\User;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function allIndex(Request $request)
    {
        $carts = Cart::with(['cartItems', 'user'])->get();

        return view('admin.carts.index', compact('carts'));
    }

    public function index(User $user)
    {
        $user = User::with('cart')->findOrFail($user->id);
        $carts = $user->cart()->with(['cartItems', 'user'])->get();
        return view('users.carts.index', compact('carts'));
    }

    public function create() {}

    public function store(Request $request, User $user)
    {
        // to store cart, we should have at least one cart item
        $validated = $request->validate([
            'product_id' => 'required',
            'quantity' => 'required',
        ]);

        if (!$user->cart()->exists()) {
            $user->cart()->create([
                'user_id' => $user->id,
            ]);
        }
        $cart = $user->cart();
        $cart = $cart->with(['cartItems', 'user'])->first();
        $cartItem = $cart->cartItems()->where('product_id', $validated['product_id'])->first();
        info($cartItem);

        if ($cartItem) {
            $cartItem->update([
                'quantity' => $validated['quantity'],
            ]);
        } else {
            $cart->cartItems()->create([
                'product_id' => $validated['product_id'],
                'quantity' => $validated['quantity'],
                'user_id' => $user->id
            ]);
        }

        return redirect()->back()->with('success', 'Product added to cart successfully');
    }

    public function show(User $user, Cart $cart)
    {
        $cart = $user->cart()->where('id', $cart->id)->with(['cartItems', 'user'])->first();
        return view('users.carts.show', compact('cart'));
    }

    public function edit(User $user, Cart $cart)
    {
        // to check permission
    }

    public function update(Request $request, User $user, Cart $cart)
    {
        $validated = $request->validate([
            'product_id' => 'required',
            'quantity' => 'required',
        ]);

        $cartItem = $cart->cartItems()->where('product_id', $validated['product_id'])->first();

        if ($cartItem) {
            $cartItem->update([
                'quantity' => $validated['quantity'],
            ]);
        } else {
            $cart->cartItems()->create([
                'product_id' => $validated['product_id'],
                'quantity' => $validated['quantity'],
                'user_id' => $user->id
            ]);
        }
        return redirect()->back()->with('success', 'Product quantity updated successfully');
    }

    public function destroy(User $user, Cart $cart)
    {
        foreach ($cart->cartItems() as $cartItem) {
            $cartItem->delete();
        }

        $cart->delete();

        return redirect()->back()->with('success', 'Cart deleted successfully');
    }

    public function destroyItem(CartItem $cartItem)
    {
        $cartItem->delete();
        return redirect()->back()->with('success', 'Cart item deleted successfully');
    }
}
