@extends('components.layouts.guest')

@section('content')
    <div class="min-h-screen bg-gray-50 py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <!-- Breadcrumb -->
            <nav class="mb-6">
                <div class="flex items-center space-x-2 text-sm text-gray-600">
                    <a href="{{ route('products.index') }}" class="hover:text-blue-600">
                        Products
                    </a>
                    <span>›</span>
                    <span class="text-gray-900">{{ $product->name }}</span>
                </div>
            </nav>

            <!-- Product Card -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 p-8">
                    <!-- Product Image -->
                    <div class="flex items-center justify-center bg-gray-50 rounded-xl p-6">
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}"
                            class="w-full h-auto max-h-96 object-contain rounded-lg">
                    </div>

                    <!-- Product Details -->
                    <div class="flex flex-col">
                        <h1 class="text-3xl font-bold text-gray-900 mb-4">
                            {{ $product->name }}
                        </h1>

                        <!-- Description -->
                        <p class="text-gray-600 mb-6 leading-relaxed">
                            {{ $product->description }}
                        </p>

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
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                <span class="text-gray-700">Availability:</span>
                                <span class="font-semibold {{ $product->quantity > 0 ? 'text-green-600' : 'text-red-600' }}">
                                    @if($product->quantity > 0)
                                        In Stock ({{ $product->quantity }} items)
                                    @else
                                        Out of Stock
                                    @endif
                                </span>
                            </div>

                            <div class="flex items-center justify-between p-4 bg-blue-50 rounded-lg border border-blue-100">
                                <span class="text-lg text-gray-700">Price:</span>
                                <span class="text-3xl font-bold text-blue-600">
                                    NPR {{ number_format($product->price / 100, 2) }}
                                </span>
                            </div>
                        </div>

                        <!-- Quantity Selector -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Quantity</label>
                            <div class="flex items-center space-x-4">
                                <div class="flex items-center border border-gray-300 rounded-lg bg-white">
                                    <button type="button"
                                        class="w-10 h-10 bg-gray-50 hover:bg-gray-100 text-gray-700 font-bold flex items-center justify-center"
                                        onclick="decreaseQuantity()">
                                        -
                                    </button>
                                    <input type="number" name="quantity" id="quantity-input" value="1" min="1"
                                        max="{{ $product->quantity }}"
                                        class="w-16 h-10 text-center border-none focus:outline-none focus:ring-0">
                                    <button type="button"
                                        class="w-10 h-10 bg-gray-50 hover:bg-gray-100 text-gray-700 font-bold flex items-center justify-center"
                                        onclick="increaseQuantity()">
                                        +
                                    </button>
                                </div>
                                <span class="text-sm text-gray-500">Max: {{ $product->quantity }}</span>
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
                                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg transition-colors duration-300 disabled:opacity-50 disabled:cursor-not-allowed">
                                        <i class="fas fa-shopping-cart mr-2"></i>
                                        Add to Cart
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('login') }}"
                                    class="block w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg transition-colors duration-300 text-center">
                                    <i class="fas fa-shopping-cart mr-2"></i>
                                    Add to Cart
                                </a>
                            @endif

                            <a href="{{ route('products.index') }}"
                                class="block w-full bg-gray-100 hover:bg-gray-200 text-gray-800 font-semibold py-3 px-6 rounded-lg transition-colors duration-300 text-center">
                                <i class="fas fa-arrow-left mr-2"></i>
                                Continue Shopping
                            </a>
                        </div>
                    </div>
                </div>
            </div>
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
@endsection