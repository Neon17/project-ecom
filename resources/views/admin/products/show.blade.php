<x-layouts.admin>
    <div class="max-w-2xl mx-auto py-8">
        <!-- Header -->
        <div class="mb-6">
            <a href="{{ route('admin.products.index') }}"
                class="text-blue-600 hover:text-blue-800 text-sm flex items-center gap-1 mb-3">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back
            </a>
            <h1 class="text-2xl font-bold text-gray-900">Product Details</h1>
        </div>

        <!-- Product Info Card -->
        <div class="bg-white rounded-lg shadow p-6">

            <!-- Name -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                <div class="px-3 py-2 bg-gray-50 border border-gray-200 rounded-md text-gray-800">
                    {{ $product->name }}
                </div>
            </div>

            <!-- Description -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                <div class="px-3 py-2 bg-gray-50 border border-gray-200 rounded-md text-gray-800 min-h-24">
                    {{ $product->description }}
                </div>
            </div>

            <!-- Price & Quantity -->
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Price</label>
                    <div class="px-3 py-2 bg-gray-50 border border-gray-200 rounded-md text-gray-800">
                        {{ $product->price }} paisa
                    </div>
                    <p class="text-xs text-gray-500 mt-1">Rs. {{ number_format($product->price / 100, 2) }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Quantity</label>
                    <div class="px-3 py-2 bg-gray-50 border border-gray-200 rounded-md text-gray-800">
                        {{ $product->quantity }}
                    </div>
                </div>
            </div>

            <!-- Slug -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Slug</label>
                <div class="px-3 py-2 bg-gray-50 border border-gray-200 rounded-md text-gray-800 font-mono text-sm">
                    {{ $product->slug }}
                </div>
            </div>

            <!-- Categories -->
            @if ($product->categories->count() > 0)
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Categories</label>
                    <div class="flex flex-wrap gap-2">
                        @foreach ($product->categories as $category)
                            <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm">
                                {{ $category->name }}
                            </span>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Categories</label>
                    <p class="text-sm text-gray-500">No categories assigned</p>
                </div>
            @endif

            <!-- Actions -->
            <div class="flex justify-end gap-3 pt-4 border-t border-gray-200">
                <a href="{{ route('admin.products.index') }}"
                    class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                    Close
                </a>
                <a href="{{ route('admin.products.edit', $product->id) }}"
                    class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                    Edit Product
                </a>
            </div>
        </div>
    </div>
</x-layouts.admin>
