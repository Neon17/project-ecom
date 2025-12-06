<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $cart = null;
        if ($user) {
            $cart = $user->cart()->with(['cartItems.product', 'user'])->first();
        }
        return view('user.carts.index', compact('cart'));
    }

    public function create() {}

    public function store(Request $request, User $user = null)
    {
        // Get the authenticated user
        $user = Auth::user();
        
        if (!$user) {
            return redirect()->route('login');
        }

        // Validate request
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        // Get the product to check stock
        $product = Product::findOrFail($validated['product_id']);
        
        // Get or create cart for the user
        $cart = $user->cart()->firstOrCreate([
            'user_id' => $user->id
        ]);

        // Check if product already exists in cart
        $cartItem = $cart->cartItems()->where('product_id', $validated['product_id'])->first();
        
        // Calculate total quantity (existing + new)
        $totalQuantity = $cartItem ? ($cartItem->quantity + $validated['quantity']) : $validated['quantity'];
        
        // Check if total quantity exceeds available stock
        if ($totalQuantity > $product->quantity) {
            $availableToAdd = $product->quantity - ($cartItem ? $cartItem->quantity : 0);
            if ($availableToAdd <= 0) {
                return redirect()->back()->with('error', 'Stock full! This product is already at maximum quantity in your cart.');
            }
            return redirect()->back()->with('error', "Stock full! You can only add {$availableToAdd} more of this item. (Available: {$product->quantity}, In cart: {$cartItem->quantity})");
        }

        if ($cartItem) {
            // Update existing cart item quantity (increment it)
            $cartItem->increment('quantity', $validated['quantity']);
        } else {
            // Create new cart item
            $cartItem = $cart->cartItems()->create([
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
        return view('user.carts.show', compact('cart'));
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
        if ($cartItem->cart->cartItems->count() == 1) {
            $cartItem->cart->delete();
        }
        $cartItem->delete();
        return redirect()->back()->with('success', 'Cart item deleted successfully');
    }
}
