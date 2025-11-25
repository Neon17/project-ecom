<x-layouts.admin>
    <div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8 bg-gray-100 min-h-screen rounded-lg shadow-md mt-8">
        <div class="bg-white rounded-lg shadow-md p-6 mb-8 flex justify-between items-center">
            <h1 class="text-3xl font-bold text-gray-900">Edit Product #{{ $product->id }}</h1>
            <a href="{{ route('admin.products.index') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition-colors duration-200 font-medium">
                <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to Products List
            </a>
        </div>

        <form action="{{ route('admin.products.update', $product->id) }}" method="post" enctype="multipart/form-data"
            class="bg-white rounded-lg shadow-md border border-gray-200 p-8 space-y-6">
            @csrf
            @method('PUT')
            
            <h2 class="text-2xl font-semibold text-gray-800 mb-6 pb-4 border-b border-gray-200">Product Details</h2>

            <div class="space-y-6">
                <!-- Product Name -->
                <div>
                    <x-ui.input-form name="name" value="{{ $product->name }}" label="Product Name" required />
                </div>

                <!-- Description -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Description <span class="text-red-500">*</span></label>
                    <textarea name="description" rows="5"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                        required>{{ $product->description }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Price -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Price (NPR) <span class="text-red-500">*</span></label>
                        <input type="number" name="price" value="{{ number_format($product->price / 100, 2) }}" required
                               class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                               placeholder="e.g., 1000.00" step="0.01" min="0">
                        @error('price')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- Quantity -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Quantity <span class="text-red-500">*</span></label>
                        <input type="number" name="quantity" value="{{ $product->quantity }}" min="0" required
                               class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                               placeholder="e.g., 100">
                        @error('quantity')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Slug -->
            <div class="mb-6">
                <x-ui.input-form name="slug" value="{{ $product->slug }}" label="Product Slug" required />
            </div>

            @if ($categories->count() > 0)
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Categories</label>
                    <select name="categories[]" multiple
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 appearance-none bg-white pr-8">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ $product->categories->contains($category->id) ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    <p class="text-xs text-gray-500 mt-2">Hold Ctrl/Cmd to select multiple categories</p>
                </div>
            @endif

            <!-- Product Image -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Product Image</label>
                
                @if($product->image)
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Current Image</label>
                        <img src="{{ $product->image_url }}" 
                             alt="{{ $product->name }}" 
                             class="max-w-xs h-auto rounded-lg border border-gray-300 shadow-sm">
                    </div>
                @endif

                <input type="file" name="image" id="image" accept="image/*"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                    onchange="previewImage(event)">
                @error('image')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
                <p class="text-xs text-gray-500 mt-2">Leave empty to keep current image. Accepted formats: JPEG, PNG, JPG, GIF, SVG (Max: 2MB)</p>
                
                <!-- Image Preview -->
                <div id="imagePreview" class="mt-4 hidden">
                    <label class="block text-sm font-medium text-gray-700 mb-2">New Image Preview</label>
                    <img id="preview" class="max-w-xs h-auto rounded-lg border border-gray-300 shadow-sm" alt="Image preview">
                </div>
            </div>

            <div class="flex justify-end gap-4 pt-4">
                <a href="{{ route('admin.products.index') }}"
                    class="px-6 py-3 bg-gray-300 text-gray-800 rounded-lg hover:bg-gray-400 transition-colors duration-300 font-semibold shadow-md">
                    Cancel
                </a>
                <button type="submit"
                    class="px-8 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-300 font-semibold text-lg shadow-lg">
                    Update Product
                </button>
            </div>
        </form>
    </div>

    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('preview');
                    const previewContainer = document.getElementById('imagePreview');
                    preview.src = e.target.result;
                    previewContainer.classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            }
        }
    </script>
</x-layouts.admin>
