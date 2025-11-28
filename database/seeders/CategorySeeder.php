<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Electronics', 'Fashion', 'Home & Decor', 'Art & Crafts', 'Sports & Outdoors',
            'Books', 'Toys & Games', 'Automotive', 'Beauty & Health', 'Grocery',
            'Garden & Outdoors', 'Pet Supplies', 'Office Products', 'Baby', 'Musical Instruments',
            'Industrial & Scientific', 'Software', 'Video Games', 'Movies & TV', 'Handmade',
            'Collectibles & Fine Art', 'Luggage & Travel Gear', 'Appliances', 'Computers', 'Smart Home'
        ];

        foreach ($categories as $categoryName) {
            Category::firstOrCreate(
                ['name' => $categoryName],
                ['slug' => Str::slug($categoryName)]
            );
        }
    }
}
