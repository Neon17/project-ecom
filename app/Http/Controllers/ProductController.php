<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getResults($request, $query)
    {
        return $query
            ->where('name', 'like', '%'.$request->input('search').'%')
            ->orWhere('description', 'like', '%'.$request->input('search').'%')
            ->orWhere('price', 'like', '%'.$request->input('search').'%');
    }

    public function index(Request $request)
    {
        $query = Product::query()->with('categories');

        if ($request->has('search') && $request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->has('category_id') && $request->category_id) {
            $query->whereHas('categories', function ($q) use ($request) {
                $q->where('categories.id', $request->category_id);
            });
        }

        if ($request->has('min_price') && $request->min_price) {
            $query->where('price', '>=', $request->min_price * 100);
        }

        if ($request->has('max_price') && $request->max_price) {
            $query->where('price', '<=', $request->max_price * 100);
        }

        $products = $query->latest()->paginate(12);
        $categories = \App\Models\Category::all();

        return view('products.index', compact('products', 'categories'));
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }
}
