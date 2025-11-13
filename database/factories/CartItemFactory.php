<?php

namespace Database\Factories;

use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CartItem>
 */
class CartItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $product = Product::factory()->create();

        return [
            'quantity' => fake()->numberBetween(1, min(5, $product->quantity)),
            'product_id' => $product->id,
            'cart_id' => Cart::factory(),
            'user_id' => User::factory(),
            'price' => $product->price
        ];
    }

    public function configure()
    {
        return $this->afterMaking(function($cartItem) {
            if (! $cartItem->product_id) {
                $product = Product::factory()->create()->id;
                $cartItem->product_id = $product->id;
                $cartItem->quantity = fake()->numberBetween(1, min(5, $product->quantity));
            }
        });
    }
}
