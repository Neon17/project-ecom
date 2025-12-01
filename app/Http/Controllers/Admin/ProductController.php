<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Services\TypesenseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function getResults($request, $query)
    {
        return $query
            ->where('name', 'like', '%'.$request->input('search').'%')
            ->orWhere('description', 'like', '%'.$request->input('search').'%')
            ->orWhere('price', 'like', '%'.$request->input('search').'%');
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
                    
                    // Maintain Typesense relevance order if possible, or just latest
                    // For admin panel, latest might still be preferred, or we can order by field
                    $idsString = implode(',', $ids);
                    $query->orderByRaw("FIELD(id, $idsString)");
                } else {
                    $query->where('id', 0); // No results
                }
            } catch (\Exception $e) {
                // Fallback to SQL search
                $query->where(function ($q) use ($request) {
                    $q->where('name', 'like', '%' . $request->search . '%')
                      ->orWhere('description', 'like', '%' . $request->search . '%');
                });
            }
        } else {
            // Apply filters for non-search requests
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
            
            $query->latest();
        }

        $products = $query->paginate(10);
        $categories = Category::all();

        return view('admin.products.index', compact('products', 'categories'));
    }

    private function buildTypesenseFilter(Request $request)
    {
        $filters = [];

        if ($request->has('category_id') && $request->category_id) {
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

    public function create()
    {
        $categories = Category::query()->get();

        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:products,name',
            'description' => 'required',
            'price' => 'required|numeric|min:0',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'quantity' => 'required|numeric|min:0',
            'categories' => 'sometimes|array|min:1',
            'categories.*' => 'exists:categories,id',
        ]);

        $slug = Str::slug($validated['name']);

        if (! Product::where('slug', $slug)->exists()) {
            $validated['slug'] = $slug;
        } else {
            info('This product already exists. Please edit the product to change it.');

            return redirect()->back()->with('error', 'This product already exists. Please edit the product to change it.');
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('products', 'public');
            $validated['image'] = $imagePath;
        }

        $product = Product::create($validated);

        if (array_key_exists('categories', $validated) && $validated['categories']) {
            $product->categories()->attach($validated['categories']);
        }

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
    }

    public function show(string $id)
    {
        $product = Product::with('categories')->findOrFail($id);
        $categories = Category::query()->get();

        return view('admin.products.show', compact('product', 'categories'));
    }

    public function edit(string $id)
    {
        $product = Product::with('categories')->findOrFail($id);
        $categories = Category::query()->get();

        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, string $id)
    {
        $product = Product::with('categories')->findOrFail($id);

        $validated = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric|min:0',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'quantity' => 'required|numeric|min:0',
            'slug' => 'required',
            'categories' => 'sometimes|array|min:1',
            'categories.*' => 'exists:categories,id',
        ]);

        $slug = $validated['slug'] ?? Str::slug($validated['name']);

        if (! Product::where(
            ['slug' => $slug, 'id' => '!=', $product->id]
        )->exists()) {
            $validated['slug'] = $slug;
        } else {
            return redirect()->back()->with('error', 'This slug already exists. Please make the slug unique. Or you change the product name and try again.');
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
            
            $image = $request->file('image');
            $imagePath = $image->store('products', 'public');
            $validated['image'] = $imagePath;
        }

        $product->update($validated);

        if (array_key_exists('categories', $validated) && $validated['categories']) {
            $product->categories()->sync($validated['categories']);
        }

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(string $id)
    {
        $product = Product::with('categories')->findOrFail($id);
        
        // Delete image if exists
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }
        
        $product->delete();

        return redirect()->route('admin.products.index');
    }
}
