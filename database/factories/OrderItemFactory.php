<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderItem>
 */
class OrderItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $product = Product::factory()->create();
        $quantity = fake()->numberBetween(1, 5);
        $unitPrice = $product->price;

        return [
            'order_id' => Order::factory(),
            'product_id' => $product->id,
            'quantity' => $quantity,
            'amount_per_item' => $unitPrice,
        ];
    }

    public function configure(): static
    {
        return $this->afterMaking(function ($orderItem) {
            if (!$orderItem->product_id) {
                $product = Product::factory()->create();
                $orderItem->product_id = $product->id;
                $orderItem->amount_per_item = $product->price;
            }
        });
    }
}
