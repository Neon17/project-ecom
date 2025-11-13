<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'street_address_1' => fake()->address(),
            'country' => fake()->country(),
            'city' => fake()->city(),
            'state' => fake()->state(),
            'street_address_2' => fake()->optional()->address(),
            'user_id' => User::factory(),
        ];
    }
}
