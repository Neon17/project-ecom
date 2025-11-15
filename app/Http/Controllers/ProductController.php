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
        $query = Product::query();
        if ($request->has('search')) {
            $query = $this->getResults($request, $query);
        }
        $products = $query->paginate(30);

        return view('products.index', compact('products'));
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }
}
