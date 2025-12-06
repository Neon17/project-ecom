<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class CartMergeController extends Controller
{
    public function merge(Request $request)
    {
        $request->validate([
            'cart' => 'required|array',
            'cart.*.id' => 'required|exists:products,id',
            'cart.*.quantity' => 'required|integer|min:1',
        ]);

        $user = $request->user();
        $guestCart = $request->input('cart');

        DB::transaction(function () use ($user, $guestCart) {
            $cart = $user->cart()->firstOrCreate(['user_id' => $user->id]);

            foreach ($guestCart as $item) {
                $product = Product::find($item['id']);
                if (!$product) continue;

                $cartItem = $cart->cartItems()->where('product_id', $item['id'])->first();

                if ($cartItem) {
                    // If product exists in DB cart, keep DB version (as per requirement: "choose the already saved one")
                    // So we do nothing here.
                } else {
                    // If not in DB, add it
                    // Check stock first? Assuming we add what we can.
                    $quantityToAdd = min($item['quantity'], $product->quantity);
                    
                    if ($quantityToAdd > 0) {
                        $cart->cartItems()->create([
                            'product_id' => $product->id,
                            'quantity' => $quantityToAdd,
                            'user_id' => $user->id,
                        ]);
                    }
                }
            }
        });

        return response()->json(['success' => true]);
    }
}
