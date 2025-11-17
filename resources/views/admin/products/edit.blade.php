<x-layouts.admin>
    <div class="max-w-2xl mx-auto py-8">

        <div class="mb-6">
            <a href="{{ route('admin.products.index') }}"
                class="text-blue-600 hover:text-blue-800 text-sm flex items-center gap-1 mb-3">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back
            </a>
            <h1 class="text-2xl font-bold text-gray-900">Edit Product</h1>
        </div>

        <form action="{{ route('admin.products.update', $product->id) }}" method="post"
            class="bg-white rounded-lg shadow p-6">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <x-ui.input-form name="name" value="{{ $product->name }}" required />
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                <textarea name="description" rows="4"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    required>{{ $product->description }}</textarea>
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <x-ui.input-form name="price" label="Price (paisa)" value="{{ $product->price }}" required />
                    <p class="text-xs text-gray-500 mt-1">100 paisa = Rs. 1</p>
                </div>
                <div>
                    <x-ui.input-form name="quantity" type="number" min="0" value="{{ $product->quantity }}"
                        required />
                </div>
            </div>

            <div class="mb-4">
                <x-ui.input-form name="slug" value="{{ $product->slug }}" required />
            </div>

            @if ($categories->count() > 0)
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Categories</label>
                    <select name="categories[]" multiple
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ $product->categories->contains($category->id) ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    <p class="text-xs text-gray-500 mt-1">Hold Ctrl to select multiple</p>
                </div>
            @endif

            <div class="flex justify-end gap-3">
                <a href="{{ route('admin.products.index') }}"
                    class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                    Cancel
                </a>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                    Update Product
                </button>
            </div>
        </form>
    </div>
</x-layouts.admin>
