<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function getResults($request, $query)
    {
        return $query
            ->where('name', 'like', '%'.$request->input('search').'%')
            ->orWhere('slug', 'like', '%'.$request->input('search').'%');
    }

    public function index(Request $request)
    {
        $categories = Category::query();
        if ($request->has('search')) {
            $categories = $this->getResults($request, $categories);
        }
        $categories = $categories->get();

        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->merge([
            'name' => strtolower($request->name),
        ]);
        $validated = $request->validate([
            'name' => 'required|unique:categories,name',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        if (! Category::where('slug', $validated['slug'])->exists()) {
            $validated['slug'] = $validated['slug'];
        } else {
            return redirect()->back()->with('error', 'This category already exists. Please edit the category to change it.');
        }

        Category::create($validated);

        return redirect()->back()->with('success', 'Category created successfully.');
    }

    public function show(Category $category)
    {
        return view('admin.categories.show', compact('category'));
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->merge([
            'name' => strtolower($request->name),
        ]);
        $validated = $request->validate([
            'name' => 'required|unique:categories,name,'.$category->id,
            'slug' => 'required|unique:categories,slug,'.$category->id,
        ]);

        if (!$request->slug) 
        {
            $validated['slug'] = Str::slug($validated['name']);
        }

        $category->update($validated);

        return redirect()->back()->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully.');
    }
}
