<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
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

        $products = $query->latest()->paginate(10);
        $categories = Category::all();

        return view('admin.products.index', compact('products', 'categories'));
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

        Product::create($validated);

        if (array_key_exists('categories', $validated) && $validated['categories']) {
            $product = Product::latest()->first();
            $product->categories()->attach($validated['categories']);
        }

        // if ($request->hasFile('image')) {
        //     $image = $request->file('image');
        //     $imageName = time() . '.' . $image->getClientOriginalExtension();
        //     $image->move(public_path('images'), $imageName);
        //     $product->image = $imageName;
        //     $product->save();
        // }

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

        $product->update($validated);

        if (array_key_exists('categories', $validated) && $validated['categories']) {
            $product->categories()->sync($validated['categories']);
        }

        // if ($request->hasFile('image')) {
        //     $image = $request->file('image');
        //     $imageName = time() . '.' . $image->getClientOriginalExtension();
        //     $image->move(public_path('images'), $imageName);
        //     $product->image = $imageName;
        //     $product->save();
        // }

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(string $id)
    {
        $product = Product::with('categories')->findOrFail($id);
        $product->delete();

        return redirect()->route('admin.products.index');
    }
}
