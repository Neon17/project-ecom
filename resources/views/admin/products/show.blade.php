<x-layouts.admin>
    <div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8 bg-gray-100 min-h-screen rounded-lg shadow-md mt-8">
        <!-- Header -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-8 flex justify-between items-center">
            <h1 class="text-3xl font-bold text-gray-900">Product Details #{{ $product->id }}</h1>
            <a href="{{ route('admin.products.index') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition-colors duration-200 font-medium">
                Back to Products List
            </a>
        </div>

        <!-- Product Info Card -->
        <div class="bg-white rounded-lg shadow-md border border-gray-200 p-8 space-y-6">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6 pb-4 border-b border-gray-200">Product Information</h2>

            <!-- Name -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Name</label>
                <p class="px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg text-gray-800 font-medium cursor-not-allowed">
                    {{ $product->name }}
                </p>
            </div>

            <!-- Description -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                <p class="px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg text-gray-800 min-h-24 font-medium cursor-not-allowed">
                    {{ $product->description }}
                </p>
            </div>

            <!-- Price & Quantity -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Price (NPR)</label>
                    <p class="px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg text-gray-800 font-medium cursor-not-allowed">
                        {{ number_format($product->price / 100, 2) }}
                    </p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Quantity</label>
                    <p class="px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg text-gray-800 font-medium cursor-not-allowed">
                        {{ $product->quantity }}
                    </p>
                </div>
            </div>

            <!-- Slug -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Slug</label>
                <p class="px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg text-gray-800 font-mono text-sm font-medium cursor-not-allowed">
                    {{ $product->slug }}
                </p>
            </div>

            <!-- Categories -->
            @if ($product->categories->count() > 0)
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Categories</label>
                    <div class="flex flex-wrap gap-3 p-4 bg-gray-50 border border-gray-300 rounded-lg">
                        @foreach ($product->categories as $category)
                            <span class="px-4 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-medium">
                                {{ $category->name }}
                            </span>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Categories</label>
                    <p class="text-base text-gray-500 p-4 bg-gray-50 border border-gray-300 rounded-lg">No categories assigned</p>
                </div>
            @endif

            <!-- Product Image -->
            <!-- Product Image -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Product Image</label>
                @if($product->image)
                    <div class="p-4 bg-gray-50 border border-gray-300 rounded-lg">
                        <img src="{{ $product->image_url }}" 
                             alt="{{ $product->name }}" 
                             class="max-w-md h-auto rounded-lg shadow-md">
                    </div>
                @else
                    <p class="text-base text-gray-500 p-4 bg-gray-50 border border-gray-300 rounded-lg">No image uploaded</p>
                @endif
            </div>

            <!-- Actions -->
            <div class="flex justify-end gap-4 pt-6 border-t border-gray-200">
                <a href="{{ route('admin.products.index') }}"
                    class="px-6 py-3 bg-gray-300 text-gray-800 rounded-lg hover:bg-gray-400 transition-colors duration-300 font-semibold shadow-md">
                    Close
                </a>
                <a href="{{ route('admin.products.edit', $product->id) }}"
                    class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-300 font-semibold shadow-md">
                    Edit Product
                </a>
            </div>
        </div>
    </div>
</x-layouts.admin>
