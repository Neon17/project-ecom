<x-layouts.guest>
    <div class="min-h-screen bg-gray-50 dark:bg-slate-800 py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <!-- Breadcrumb -->
            <nav class="mb-6">
                <div class="flex items-center space-x-2 text-sm text-gray-600 dark:text-gray-300">
                    <a href="{{ route('products.index') }}" class="hover:text-blue-600 dark:text-blue-400">
                        Products
                    </a>
                    <span>›</span>
                    <span class="text-gray-900 dark:text-white">{{ $product->name }}</span>
                </div>
            </nav>

            <!-- Product Card -->
            <div class="bg-white dark:bg-slate-900 rounded-xl shadow-lg overflow-hidden">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 p-8">
                    <!-- Product Image -->
                    <div class="flex items-center justify-center bg-gray-50 dark:bg-slate-800 rounded-xl p-6">
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}"
                            class="w-full h-auto max-h-96 object-contain rounded-lg">
                    </div>

                    <!-- Product Details -->
                    <div class="flex flex-col">
                        <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">
                            {{ $product->name }}
                        </h1>

                        <!-- Description -->
                        <div class="text-gray-600 dark:text-gray-300 mb-6 leading-relaxed prose prose-sm dark:prose-invert max-w-none">
                            {!! nl2br(e($product->description)) !!}
                        </div>

                        <!-- Categories -->
                        @if ($product->categories->count() > 0)
                            <div class="mb-6">
                                <div class="flex flex-wrap gap-2">
                                    @foreach ($product->categories as $category)
                                        <span class="inline-block bg-blue-100 text-blue-700 text-sm px-3 py-1 rounded-full">
                                            {{ $category->name }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- Availability & Price -->
                        <div class="space-y-4 mb-6">
                            <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-slate-800 rounded-lg">
                                <span class="text-gray-700 dark:text-gray-300">Availability:</span>
                                <span class="font-semibold {{ $product->quantity > 0 ? 'text-green-600' : 'text-red-600' }}">
                                    @if($product->quantity > 0)
                                        In Stock ({{ $product->quantity }} items)
                                    @else
                                        Out of Stock
                                    @endif
                                </span>
                            </div>

                            <div class="flex items-center justify-between p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg border border-blue-100 dark:border-blue-800">
                                <span class="text-lg text-gray-700 dark:text-gray-300">Price:</span>
                                <span class="text-3xl font-bold text-blue-600 dark:text-blue-400">
                                    NPR {{ number_format($product->price, 2) }}
                                </span>
                            </div>
                        </div>

                        <!-- Quantity Selector -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Quantity</label>
                            <div class="flex items-center space-x-4">
                                <div class="flex items-center border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-slate-900">
                                    <button type="button"
                                        class="w-10 h-10 bg-gray-50 dark:bg-slate-800 hover:bg-gray-100 dark:hover:bg-slate-700 text-gray-700 dark:text-gray-300 font-bold flex items-center justify-center"
                                        onclick="decreaseQuantity()">
                                        -
                                    </button>
                                    <input type="number" name="quantity" id="quantity-input" value="1" min="1"
                                        max="{{ $product->quantity }}"
                                        class="w-16 h-10 text-center border-none focus:outline-none focus:ring-0 bg-transparent text-gray-900 dark:text-white">
                                    <button type="button"
                                        class="w-10 h-10 bg-gray-50 dark:bg-slate-800 hover:bg-gray-100 dark:hover:bg-slate-700 text-gray-700 dark:text-gray-300 font-bold flex items-center justify-center"
                                        onclick="increaseQuantity()">
                                        +
                                    </button>
                                </div>
                                <span class="text-sm text-gray-500 dark:text-gray-400">Max: {{ $product->quantity }}</span>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="space-y-3">
                            @if (auth()->check())
                                <form action="{{ route('user.cart.store') }}"
                                    method="POST" class="w-full">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="quantity" id="quantity-hidden" value="1">
                                    <button type="submit" {{ $product->quantity === 0 ? 'disabled' : '' }}
                                        class="w-full bg-blue-600 hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600 text-white font-bold py-3 px-6 rounded-lg transition-colors duration-300 disabled:opacity-50 disabled:cursor-not-allowed">
                                        <i class="fas fa-shopping-cart mr-2"></i>
                                        Add to Cart
                                    </button>
                                </form>
                            @else
                                <button type="button" x-data
                                    @click="$dispatch('add-to-cart-guest', {
                                        id: {{ $product->id }},
                                        name: '{{ addslashes($product->name) }}',
                                        price: {{ $product->price }},
                                        image: '{{ $product->image_url }}',
                                        quantity: parseInt(document.getElementById('quantity-input').value),
                                        max_quantity: {{ $product->quantity }}
                                    })"
                                    class="block w-full bg-blue-600 hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600 text-white font-bold py-3 px-6 rounded-lg transition-colors duration-300 text-center">
                                    <i class="fas fa-shopping-cart mr-2"></i>
                                    Add to Cart
                                </button>
                            @endif

                            <a href="{{ route('products.index') }}"
                                class="block w-full bg-gray-100 dark:bg-slate-800 hover:bg-gray-200 dark:hover:bg-slate-700 text-gray-800 dark:text-gray-200 font-semibold py-3 px-6 rounded-lg transition-colors duration-300 text-center">
                                <i class="fas fa-arrow-left mr-2"></i>
                                Continue Shopping
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Related Products -->
            @if(isset($relatedProducts) && $relatedProducts->count() > 0)
                <div class="mt-12">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Related Products</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                        @foreach($relatedProducts as $relatedProduct)
                            <div class="bg-white dark:bg-slate-900 rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                                <a href="{{ route('products.show', $relatedProduct) }}">
                                    <div class="relative h-48 bg-gray-100 dark:bg-slate-800">
                                        <img src="{{ $relatedProduct->image_url }}" alt="{{ $relatedProduct->name }}"
                                            class="w-full h-full object-cover">
                                    </div>
                                    <div class="p-4">
                                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2 truncate">{{ $relatedProduct->name }}</h3>
                                        <div class="flex items-center justify-between">
                                            <span class="text-blue-600 dark:text-blue-400 font-bold">NPR {{ number_format($relatedProduct->price, 2) }}</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>

    <script>
        function increaseQuantity() {
            const quantityInput = document.getElementById('quantity-input');
            const maxQuantity = parseInt(quantityInput.getAttribute('max'));
            let currentValue = parseInt(quantityInput.value);

            if (currentValue < maxQuantity) {
                quantityInput.value = currentValue + 1;
                updateHiddenQuantities();
            }
        }

        function decreaseQuantity() {
            const quantityInput = document.getElementById('quantity-input');
            let currentValue = parseInt(quantityInput.value);

            if (currentValue > 1) {
                quantityInput.value = currentValue - 1;
                updateHiddenQuantities();
            }
        }

        function updateHiddenQuantities() {
            const quantityInput = document.getElementById('quantity-input');
            const hiddenInput = document.getElementById('quantity-hidden');
            
            hiddenInput.value = quantityInput.value;
        }

        document.addEventListener('DOMContentLoaded', function() {
            updateHiddenQuantities();

            document.getElementById('quantity-input').addEventListener('change', function() {
                const maxQuantity = parseInt(this.getAttribute('max'));
                const minQuantity = parseInt(this.getAttribute('min'));
                let value = parseInt(this.value);

                if (isNaN(value) || value < minQuantity) {
                    this.value = minQuantity;
                } else if (value > maxQuantity) {
                    this.value = maxQuantity;
                }

                updateHiddenQuantities();
            });
        });
    </script>
</x-layouts.guest>