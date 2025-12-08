<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Services\TypesenseService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getResults($request, $query)
    {
        return $query
            ->where('name', 'like', '%' . $request->input('search') . '%')
            ->orWhere('slug', 'like', '%' . $request->input('search') . '%')
            ->orWhere('description', 'like', '%' . $request->input('search') . '%')
            ->orWhere('price', 'like', '%' . $request->input('search') . '%');
    }

    public function index(Request $request, TypesenseService $typesense)
    {
        $query = Product::query()->with('categories');

        if ($request->has('search') && $request->search) {
            try {
                $searchResult = $typesense->searchProducts($request->search, [
                    'query_by' => 'name,description',
                    'filter_by' => $this->buildTypesenseFilter($request),
                ]);

                $ids = array_column($searchResult['hits'] ?? [], 'document');
                $ids = array_column($ids, 'id');

                if (!empty($ids)) {
                    $query->whereIn('id', $ids);

                    // Simple approach: Don't try to maintain Typesense order
                    // Just use regular ordering since relevance is already handled by Typesense
                    $query->latest();
                } else {
                    $query->where('id', 0); // No results
                }
            } catch (\Exception $e) {

                $query->where(function ($q) use ($request) {
                    $q->where('name', 'like', '%' . $request->search . '%')
                        ->orWhere('description', 'like', '%' . $request->search . '%');
                });
            }
        } else {
            // Apply filters for non-search requests
            // Handle multiple categories
            if ($request->has('categories') && is_array($request->categories) && count($request->categories) > 0) {
                $categorySlugs = $request->categories;
                $categoryIds = Category::whereIn('slug', $categorySlugs)->pluck('id');
                if ($categoryIds->isNotEmpty()) {
                    $query->whereHas('categories', function ($q) use ($categoryIds) {
                        $q->whereIn('categories.id', $categoryIds);
                    });
                }
            } elseif ($request->has('category') && $request->category) {
                // Fallback for single category (legacy support)
                $category = Category::where('slug', $request->category)->first();
                if ($category) {
                    $query->whereHas('categories', function ($q) use ($category) {
                        $q->where('categories.id', $category->id);
                    });
                }
            } elseif ($request->has('category_id') && $request->category_id) {
                // Fallback for legacy ID support if needed
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
        }

        $products = $query->latest()->paginate(12);
        $categories = Category::all();

        return view('products.index', compact('products', 'categories'));
    }

    private function buildTypesenseFilter(Request $request)
    {
        $filters = [];

        // Handle multiple categories
        if ($request->has('categories') && is_array($request->categories) && count($request->categories) > 0) {
            $categorySlugs = $request->categories;
            $categoryIds = Category::whereIn('slug', $categorySlugs)->pluck('id')->toArray();
            if (!empty($categoryIds)) {
                // Typesense filter for multiple category IDs (OR logic)
                $filters[] = 'category_ids:=[' . implode(',', $categoryIds) . ']';
            }
        } elseif ($request->has('category') && $request->category) {
            $category = Category::where('slug', $request->category)->first();
            if ($category) {
                $filters[] = 'category_ids:=[' . $category->id . ']';
            }
        } elseif ($request->has('category_id') && $request->category_id) {
            $filters[] = 'category_ids:=[' . $request->category_id . ']';
        }

        if ($request->has('min_price') && $request->min_price) {
            $filters[] = 'price:>=' . ($request->min_price * 100);
        }

        if ($request->has('max_price') && $request->max_price) {
            $filters[] = 'price:<=' . ($request->max_price * 100);
        }

        return implode(' && ', $filters);
    }

    public function show(Product $product, TypesenseService $typesense)
    {
        $relatedProducts = collect();

        try {
            // Try Typesense "More Like This" (using name and description)
            // A simple approximation is searching for the product name excluding the current product

            $searchResult = $typesense->searchProducts($product->name, [
                'query_by' => 'name,description',
                'filter_by' => 'id:!=[' . $product->id . ']',
                'per_page' => 4,
            ]);

            $ids = array_column($searchResult['hits'], 'document');
            $ids = array_column($ids, 'id');

            if (!empty($ids)) {
                $idsString = implode(',', $ids);
                $relatedProducts = Product::whereIn('id', $ids)
                    ->orderByRaw("FIELD(id, $idsString)")
                    ->get();
            }
        } catch (\Exception $e) {
            // Fallback: Same Category
        }

        if ($relatedProducts->isEmpty()) {
            $categoryIds = $product->categories->pluck('id');
            
            if ($categoryIds->isNotEmpty()) {
                $relatedProducts = Product::whereHas('categories', function ($q) use ($categoryIds) {
                    $q->whereIn('categories.id', $categoryIds);
                })
                ->where('id', '!=', $product->id)
                ->inRandomOrder()
                ->take(4)
                ->get();
            }
            
            // If still empty (e.g., no other products in category), fetch random products
            if ($relatedProducts->isEmpty()) {
                $relatedProducts = Product::where('id', '!=', $product->id)
                    ->inRandomOrder()
                    ->take(4)
                    ->get();
            }
        }

        return view('products.show', compact('product', 'relatedProducts'));
    }
}
