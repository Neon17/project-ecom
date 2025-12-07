<x-layouts.admin>
    <div class="min-h-screen bg-gray-50 dark:bg-slate-800 py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-8">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Product Details #{{ $product->id }}</h1>
                        <p class="text-gray-600 dark:text-gray-300 dark:text-gray-600 mt-2">View product information and details</p>
                    </div>
                    <a href="{{ route('admin.products.index') }}"
                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 dark:text-gray-600 bg-white dark:bg-slate-900 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-slate-700 dark:bg-slate-800 transition-colors">
                        ← Back to Products
                    </a>
                </div>
            </div>

            <!-- Product Info Card -->
            <div class="bg-white dark:bg-slate-900 rounded-lg shadow-sm border border-gray-200 dark:border-slate-700">
                <div class="p-6 space-y-6">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white pb-4 border-b border-gray-200 dark:border-slate-700">Product Information</h2>

                    <!-- Name -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 dark:text-gray-600 mb-2">Name</label>
                        <div class="px-3 py-2 bg-gray-50 dark:bg-slate-800 border border-gray-300 dark:border-gray-600 rounded-md text-gray-900 dark:text-white">
                            {{ $product->name }}
                        </div>
                    </div>

                    <!-- Description -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 dark:text-gray-600 mb-2">Description</label>
                        <div class="px-3 py-2 bg-gray-50 dark:bg-slate-800 border border-gray-300 dark:border-gray-600 rounded-md text-gray-900 dark:text-white min-h-20">
                            {{ $product->description }}
                        </div>
                    </div>

                    <!-- Price & Quantity -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 dark:text-gray-600 mb-2">Price (NPR)</label>
                            <div class="px-3 py-2 bg-gray-50 dark:bg-slate-800 border border-gray-300 dark:border-gray-600 rounded-md text-gray-900 dark:text-white">
                                {{ number_format($product->price, 2) }}
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 dark:text-gray-600 mb-2">Quantity</label>
                            <div class="px-3 py-2 bg-gray-50 dark:bg-slate-800 border border-gray-300 dark:border-gray-600 rounded-md text-gray-900 dark:text-white">
                                {{ $product->quantity }}
                            </div>
                        </div>
                    </div>

                    <!-- Slug -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 dark:text-gray-600 mb-2">Slug</label>
                        <div class="px-3 py-2 bg-gray-50 dark:bg-slate-800 border border-gray-300 dark:border-gray-600 rounded-md text-gray-900 dark:text-white font-mono text-sm">
                            {{ $product->slug }}
                        </div>
                    </div>

                    <!-- Categories -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 dark:text-gray-600 mb-2">Categories</label>
                        @if ($product->categories->count() > 0)
                            <div class="flex flex-wrap gap-2 px-3 py-2 bg-gray-50 dark:bg-slate-800 border border-gray-300 dark:border-gray-600 rounded-md">
                                @foreach ($product->categories as $category)
                                    <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-xs font-medium">
                                        {{ $category->name }}
                                    </span>
                                @endforeach
                            </div>
                        @else
                            <div class="px-3 py-2 bg-gray-50 dark:bg-slate-800 border border-gray-300 dark:border-gray-600 rounded-md text-gray-500 dark:text-gray-400 dark:text-gray-500">
                                No categories assigned
                            </div>
                        @endif
                    </div>

                    <!-- Product Image -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 dark:text-gray-600 mb-2">Product Image</label>
                        @if($product->image)
                            <div class="bg-gray-50 dark:bg-slate-800 border border-gray-300 dark:border-gray-600 rounded-md p-4">
                                <img src="{{ $product->image_url }}" 
                                     alt="{{ $product->name }}" 
                                     class="max-w-sm h-auto rounded-lg">
                            </div>
                        @else
                            <div class="px-3 py-2 bg-gray-50 dark:bg-slate-800 border border-gray-300 dark:border-gray-600 rounded-md text-gray-500 dark:text-gray-400 dark:text-gray-500">
                                No image uploaded
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Actions -->
                <div class="bg-gray-50 dark:bg-slate-800 px-6 py-4 border-t border-gray-200 dark:border-slate-700 rounded-b-lg">
                    <div class="flex justify-end space-x-3">
                        <a href="{{ route('admin.products.index') }}"
                            class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 dark:text-gray-600 bg-white dark:bg-slate-900 border border-gray-300 dark:border-gray-600 rounded-md hover:bg-gray-50 dark:hover:bg-slate-700 dark:bg-slate-800 transition-colors">
                            Close
                        </a>
                        <a href="{{ route('admin.products.edit', $product) }}"
                            class="px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors">
                            Edit Product
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.admin>