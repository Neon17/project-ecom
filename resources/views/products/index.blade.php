@extends('components.layouts.guest')

@section('content')
    <div class="min-h-screen bg-white dark:bg-slate-900 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Sidebar Filters -->
                <div class="w-full lg:w-64 flex-shrink-0">
                    <div class="bg-white dark:bg-slate-900 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-6 sticky top-24">
                        <h2 class="text-lg font-bold text-gray-900 dark:text-white mb-6">Filters</h2>
                        
                        <form action="{{ route('products.index') }}" method="GET">
                            <!-- Search -->
                            <div class="mb-6">
                                <label for="search" class="block text-sm font-medium text-gray-700 dark:text-gray-300 dark:text-gray-600 mb-2">Search</label>
                                <input type="text" name="search" id="search" value="{{ request('search') }}" 
                                    class="w-full rounded-lg border-gray-300 dark:border-gray-600 focus:border-blue-500 focus:ring-blue-500 text-sm p-2"
                                    placeholder="Search products...">
                            </div>

                            <!-- Categories -->
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 dark:text-gray-600 mb-2">Category</label>
                                <div class="space-y-2 max-h-48 overflow-y-auto">
                                    <div class="flex items-center">
                                        <input type="radio" name="category_id" value="" id="cat_all" 
                                            {{ !request('category_id') ? 'checked' : '' }}
                                            class="h-4 w-4 text-blue-600 dark:text-blue-400 focus:ring-blue-500 border-gray-300 dark:border-gray-600">
                                        <label for="cat_all" class="ml-2 text-sm text-gray-600 dark:text-gray-300 dark:text-gray-600">All Categories</label>
                                    </div>
                                    @foreach($categories as $category)
                                        <div class="flex items-center">
                                            <input type="radio" name="category_id" value="{{ $category->id }}" id="cat_{{ $category->id }}"
                                                {{ request('category_id') == $category->id ? 'checked' : '' }}
                                                class="h-4 w-4 text-blue-600 dark:text-blue-400 focus:ring-blue-500 border-gray-300 dark:border-gray-600">
                                            <label for="cat_{{ $category->id }}" class="ml-2 text-sm text-gray-600 dark:text-gray-300 dark:text-gray-600">{{ $category->name }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Price Range -->
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 dark:text-gray-600 mb-2">Price Range (NPR)</label>
                                <div class="grid grid-cols-2 gap-2">
                                    <input type="number" name="min_price" value="{{ request('min_price') }}" placeholder="Min"
                                        class="w-full rounded-lg border-gray-300 dark:border-gray-600 focus:border-blue-500 focus:ring-blue-500 text-sm">
                                    <input type="number" name="max_price" value="{{ request('max_price') }}" placeholder="Max"
                                        class="w-full rounded-lg border-gray-300 dark:border-gray-600 focus:border-blue-500 focus:ring-blue-500 text-sm">
                                </div>
                            </div>

                            <div class="flex flex-col gap-2">
                                <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors text-sm font-medium">
                                    Apply Filters
                                </button>
                                <a href="{{ route('products.index') }}" class="w-full text-center px-4 py-2 bg-white dark:bg-slate-900 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 dark:text-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-slate-700 dark:bg-slate-800 transition-colors text-sm font-medium">
                                    Reset
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Product Grid -->
                <div class="flex-1">
                    <div class="mb-8">
                        <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Our Products</h1>
                        <p class="text-gray-500 dark:text-gray-400 dark:text-gray-500">Showing {{ $products->firstItem() ?? 0 }} - {{ $products->lastItem() ?? 0 }} of {{ $products->total() }} results</p>
                    </div>

                    @if($products->count() > 0)
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach ($products as $product)
                                <div class="group bg-white dark:bg-slate-900 rounded-xl shadow-sm hover:shadow-md transition-all duration-300 border border-gray-100 dark:border-gray-700 overflow-hidden flex flex-col h-full">
                                    <a href="{{ route('products.show', $product->id) }}" class="block relative aspect-w-4 aspect-h-3 bg-gray-100 dark:bg-slate-800 overflow-hidden">
                                        <img src="{{ $product->image_url ?? 'https://via.placeholder.com/400x300' }}" 
                                             alt="{{ $product->name }}" 
                                             class="object-cover w-full h-60 group-hover:scale-105 transition-transform duration-500">
                                        @if($product->quantity <= 0)
                                            <div class="absolute top-2 right-2 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded">
                                                Out of Stock
                                            </div>
                                        @endif
                                    </a>
                                    
                                    <div class="p-5 flex flex-col flex-1">
                                        <div class="mb-2">
                                            @foreach($product->categories->take(2) as $cat)
                                                <span class="text-xs font-medium text-blue-600 dark:text-blue-400 bg-blue-50 px-2 py-1 rounded-full mr-1">
                                                    {{ $cat->name }}
                                                </span>
                                            @endforeach
                                        </div>
                                        
                                        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2 group-hover:text-blue-600 dark:text-blue-400 transition-colors">
                                            <a href="{{ route('products.show', $product->id) }}">
                                                {{ $product->name }}
                                            </a>
                                        </h3>
                                        
                                        <p class="text-gray-500 dark:text-gray-400 dark:text-gray-500 text-sm mb-4 line-clamp-2 flex-1">
                                            {{ Str::limit($product->description, 100) }}
                                        </p>
                                        
                                        <div class="flex items-center justify-between mt-auto pt-4 border-t border-gray-100 dark:border-gray-700">
                                            <span class="text-xl font-bold text-gray-900 dark:text-white">
                                                NPR {{ number_format($product->price, 2) }}
                                            </span>
                                            
                                            <form action="{{ route('user.cart.store') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                <input type="hidden" name="quantity" value="1">
                                                <button type="submit" class="p-2 rounded-full bg-gray-100 dark:bg-slate-800 text-gray-600 dark:text-gray-300 dark:text-gray-600 hover:bg-blue-600 hover:text-white transition-colors" title="Add to Cart" {{ $product->quantity <= 0 ? 'disabled' : '' }}>
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                        <div class="mt-8">
                            {{ $products->withQueryString()->links() }}
                        </div>
                    @else
                        <div class="text-center py-12 bg-gray-50 dark:bg-slate-800 rounded-xl border border-gray-100 dark:border-gray-700">
                            <svg class="mx-auto h-12 w-12 text-gray-400 dark:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">No products found</h3>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400 dark:text-gray-500">Try adjusting your search or filters.</p>
                            <div class="mt-6">
                                <a href="{{ route('products.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    Clear Filters
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection