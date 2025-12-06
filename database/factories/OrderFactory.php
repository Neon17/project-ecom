<?php

namespace Database\Factories;

use App\Enums\OrderStatusEnum;
use App\Models\Address;
use App\Models\User;
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
            'shipping_country' => fake()->country(),
            'shipping_state' => fake()->state(),
            'shipping_city' => fake()->city(),
            'shipping_street_address_1' => fake()->streetAddress(),
            'shipping_street_address_2' => fake()->optional()->secondaryAddress(),
        ];
    }
}
