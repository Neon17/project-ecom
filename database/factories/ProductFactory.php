<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->unique()->words(3, true);

        return [
            'name' => $name,
            'price' => fake()->numberBetween(10000, 1000000), // price in paisa not rupees
            'description' => fake()->text(),
            'quantity' => fake()->numberBetween(0, 100),
            'slug' => Str::slug($name),
            'image' => fake()->imageUrl(640, 480, 'product', true),

            // consider the many to many relationship between product and categories
        ];
    }
}
