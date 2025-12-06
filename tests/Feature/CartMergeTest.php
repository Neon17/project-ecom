<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use App\Models\Cart;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CartMergeTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_merge_guest_cart()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create(['quantity' => 10]);
        
        $guestCart = [
            [
                'id' => $product->id,
                'quantity' => 2,
            ]
        ];

        $response = $this->actingAs($user)
            ->postJson(route('user.cart.merge'), ['cart' => $guestCart]);

        $response->assertOk();
        
        $this->assertDatabaseHas('cart_items', [
            'product_id' => $product->id,
            'quantity' => 2,
        ]);
    }

    public function test_merge_does_not_overwrite_existing_db_items()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create(['quantity' => 10]);
        
        // User already has 5 of this product in cart
        $cart = Cart::create(['user_id' => $user->id]);
        $cart->cartItems()->create([
            'product_id' => $product->id,
            'quantity' => 5,
            'user_id' => $user->id,
        ]);

        // Guest cart has 2 of the same product
        $guestCart = [
            [
                'id' => $product->id,
                'quantity' => 2,
            ]
        ];

        $response = $this->actingAs($user)
            ->postJson(route('user.cart.merge'), ['cart' => $guestCart]);

        $response->assertOk();
        
        // Should still be 5 (DB priority)
        $this->assertDatabaseHas('cart_items', [
            'product_id' => $product->id,
            'quantity' => 5,
        ]);
    }
}
