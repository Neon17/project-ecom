<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public static $targetCount = 50;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $productsByCategory = [
            'Electronics' => [
                ['name' => 'Laptop', 'price' => 80000],
                ['name' => 'Smartphone', 'price' => 30000],
                ['name' => 'Headphones', 'price' => 5000],
                ['name' => 'Smart Watch', 'price' => 4000],
                ['name' => 'Camera', 'price' => 45000],
            ],
            'Fashion' => [
                ['name' => 'T-Shirt', 'price' => 800],
                ['name' => 'Jeans', 'price' => 2500],
                ['name' => 'Sneakers', 'price' => 4000],
                ['name' => 'Jacket', 'price' => 3500],
                ['name' => 'Sunglasses', 'price' => 1200],
            ],
            'Home & Decor' => [
                ['name' => 'Bamboo Stick', 'price' => 500],
                ['name' => 'Vase', 'price' => 1500],
                ['name' => 'Wall Clock', 'price' => 2000],
                ['name' => 'Cushion', 'price' => 600],
                ['name' => 'Lamp', 'price' => 2500],
            ],
            'Art & Crafts' => [
                ['name' => 'Painter Set', 'price' => 3000],
                ['name' => 'Water Colors', 'price' => 400],
                ['name' => 'Canvas', 'price' => 500],
                ['name' => 'Brushes', 'price' => 300],
                ['name' => 'Sketchbook', 'price' => 250],
            ],
            'Sports & Outdoors' => [
                ['name' => 'Football', 'price' => 1500],
                ['name' => 'Cricket Bat', 'price' => 2500],
                ['name' => 'Yoga Mat', 'price' => 1200],
                ['name' => 'Badminton Racket', 'price' => 1800],
                ['name' => 'Water Bottle', 'price' => 800],
            ],
        ];

        foreach ($productsByCategory as $categoryName => $products) {
            $category = Category::where('name', $categoryName)->first();

            if (!$category) {
                continue;
            }

            foreach ($products as $productData) {
                $name = $productData['name'];
                $basePrice = $productData['price'];
                $price = $basePrice; // Model mutator handles conversion to paisa

                // Check if product already exists to avoid duplicates during re-seeding
                if (Product::where('name', $name)->exists()) {
                    continue;
                }

                // Image with text
                $imageText = str_replace(' ', '+', $name);
                $bgColor = fake()->hexColor();
                $bgColor = ltrim($bgColor, '#');
                $textColor = 'ffffff';
                $imageUrl = "https://placehold.co/600x400/{$bgColor}/{$textColor}?text={$imageText}";

                $product = Product::create([
                    'name' => $name,
                    'price' => $price,
                    'description' => fake()->paragraph(),
                    'quantity' => fake()->numberBetween(10, 100),
                    'slug' => Str::slug($name) . '-' . Str::random(5),
                    'image' => $imageUrl,
                ]);

                $product->categories()->attach($category);
            }
        }

        // Bulk seeding to reach target count
        $targetCount = self::$targetCount;
        $currentCount = Product::count();
        $remaining = $targetCount - $currentCount;

        if ($remaining > 0) {
            $this->command->info("Generating remaining {$remaining} products to reach {$targetCount}...");
            
            $chunkSize = 500;
            $chunks = ceil($remaining / $chunkSize);
            
            $bar = $this->command->getOutput()->createProgressBar($remaining);
            $bar->start();

            for ($i = 0; $i < $chunks; $i++) {
                $count = min($chunkSize, $remaining);
                
                Product::factory()
                    ->count($count)
                    ->create()
                    ->each(function ($product) {
                        // Attach 1 to 3 random categories
                        $categories = Category::inRandomOrder()->take(rand(1, 3))->get();
                        $product->categories()->attach($categories);
                    });
                
                $remaining -= $count;
                $bar->advance($count);
            }
            
            $bar->finish();
            $this->command->info("\nDone!");
        }
    }
}
