<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function getResults($request, $query)
    {
        return $query
            ->where('name', 'like', '%' . $request->input('search') . '%')
            ->orWhere('description', 'like', '%' . $request->input('search') . '%')
            ->orWhere('price', 'like', '%' . $request->input('search') . '%');
    }


    public function index(Request $request)
    {
        $query = Product::query();
        if ($request->has('search')) {
            $query = $this->getResults($request, $query);
        }
        $products = $query->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'quantity' => 'required|numeric|min:0',
            // 'categories' => 'sometimes|array|min:1',
            // 'categories.*' => 'exists:categories,id'
        ]);

        $slug = Str::slug($validated['name']);
        $slug_with_date = $slug . '-' . date('Y');

        if (!Product::where('slug', $slug)->exists()) {
            $validated['slug'] = $slug;
        } else if (!Product::where('slug', $slug_with_date)->exists()) {
            info($slug_with_date);
            $validated['slug'] = $slug_with_date;
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
        $product = Product::findOrFail($id);
        return view('admin.products.show', compact('product'));
    }

    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'quantity' => 'required|numeric|min:0',
            'slug' => 'required',
            // 'categories' => 'sometimes|array|min:1',
            // 'categories.*' => 'exists:categories,id'
        ]);

        $slug = $validated['slug']??Str::slug($validated['name']);
        $slug_with_date = $slug . '-' . date('Y');

        if (!Product::where('slug', $slug)->exists()) {
            $validated['slug'] = $slug;
        } else if (!Product::where('slug', $slug_with_date)->exists()) {
            info($slug_with_date);
            $validated['slug'] = $slug_with_date;
        } else {
            return redirect()->back()->with('error', 'This slug already exists. Please make the slug unique. Or you change the product name and try again.');
        }

        $product->update($validated);

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

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('admin.products.index');
    }
}
