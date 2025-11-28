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
        $products = [
            'Laptop' => 80000, 'Smartphone' => 30000, 'Headphones' => 5000, 
            'Bamboo Stick' => 500, 'Vase' => 1500, 'T-Shirt' => 800, 
            'Jeans' => 2500, 'Sneakers' => 4000, 'Painter Set' => 3000, 
            'Water Colors' => 400, 'Novel' => 600, 'Notebook' => 100
        ];

        $name = fake()->randomElement(array_keys($products));
        $basePrice = $products[$name];
        
        // Add some randomness to price
        $price = $basePrice + fake()->numberBetween(-100, 100);
        
        // Image with text
        $imageText = str_replace(' ', '+', $name);
        $bgColor = fake()->hexColor();
        $bgColor = ltrim($bgColor, '#');
        $textColor = 'ffffff';
        $imageUrl = "https://placehold.co/600x400/{$bgColor}/{$textColor}?text={$imageText}";

        return [
            'name' => $name,
            'price' => $price, // Model mutator handles conversion to paisa
            'description' => fake()->paragraph(),
            'quantity' => fake()->numberBetween(10, 100),
            'slug' => Str::slug($name) . '-' . Str::random(5), // Ensure unique slug
            'image' => $imageUrl,
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
