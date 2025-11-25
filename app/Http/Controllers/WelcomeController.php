<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index(Request $request)
    {
        // Get all categories with product count (filter after fetch for database compatibility)
        $categories = Category::withCount('products')
            ->orderBy('name')
            ->get()
            ->filter(function($category) {
                return $category->products_count > 0;
            });
        
        // Get selected category if any
        $selectedCategoryId = $request->query('category');
        $selectedCategory = null;
        
        // Fetch products
        $productsQuery = Product::with('categories')
            ->where('quantity', '>', 0)
            ->latest();
        
        if ($selectedCategoryId) {
            $selectedCategory = Category::find($selectedCategoryId);
            $productsQuery->whereHas('categories', function($query) use ($selectedCategoryId) {
                $query->where('categories.id', $selectedCategoryId);
            });
        }
        
        $products = $productsQuery->take(12)->get();
        
        // Get featured products (latest 8 if no category selected)
        $featuredProducts = Product::with('categories')
            ->where('quantity', '>', 0)
            ->latest()
            ->take(8)
            ->get();
        
        return view('welcome', compact('categories', 'products', 'featuredProducts', 'selectedCategory'));
    }
}
