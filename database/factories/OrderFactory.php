<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\User;
use App\OrderStatusEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'status' => fake()->randomElement(array_column(OrderStatusEnum::cases(), 'value')),
            'user_id' => User::factory(),
            'address_id' => Address::factory(),
            'status' => fake()->randomElement(array_column(OrderStatusEnum::cases(), 'value')),
        ];
    }
}
