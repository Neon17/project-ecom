<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
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
        ];
    }

    /**
     * Attach categories to the product
     */
    public function withCategories($count = null): static
    {
        return $this->afterCreating(function (Product $product) use ($count) {
            $categoryCount = $count ?? rand(1, 3);
            $categories = Category::inRandomOrder()
                ->take($categoryCount)
                ->get();

            $product->categories()->attach($categories);
        });
    }
}
