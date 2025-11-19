@extends('components.layouts.guest')

@section('content')
    <!-- Premium Product Detail Page -->
    <div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50/30 py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <!-- Breadcrumb Navigation -->
            <nav class="mb-8">
                <div class="flex items-center space-x-2 text-sm text-gray-600">
                    <a href="{{ route('products.index') }}" class="hover:text-blue-600 transition-colors">
                        <i class="fas fa-home mr-1"></i>
                        Home
                    </a>
                    <span class="text-gray-400"><i class="fas fa-chevron-right text-xs"></i></span>
                    <a href="{{ route('products.index') }}" class="hover:text-blue-600 transition-colors">
                        Products
                    </a>
                    <span class="text-gray-400"><i class="fas fa-chevron-right text-xs"></i></span>
                    <span class="text-gray-900 font-medium">{{ $product->name }}</span>
                </div>
            </nav>

            <!-- Main Product Card -->
            <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-white/80 backdrop-blur-sm">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-0">
                    <!-- Product Image Section -->
                    <div class="relative bg-gradient-to-br from-gray-50 to-gray-100 p-8 lg:p-12">
                        <div class="sticky top-8">
                            <!-- Premium Badge -->
                            <div class="absolute top-4 left-4 z-10">
                                <span class="bg-gradient-to-r from-amber-500 to-amber-600 text-white text-sm font-bold px-4 py-2 rounded-full shadow-lg">
                                    <i class="fas fa-crown mr-2"></i>
                                    Premium
                                </span>
                            </div>
                            
                            <!-- Image Container -->
                            <div class="flex items-center justify-center p-6 bg-white/80 rounded-2xl shadow-inner backdrop-blur-sm">
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                    class="w-full h-auto max-h-[480px] object-contain rounded-xl transform transition-transform duration-500 hover:scale-105">
                            </div>
                            
                            <!-- Image Gallery (Placeholder) -->
                            <div class="flex justify-center space-x-4 mt-6">
                                <div class="w-16 h-16 bg-gray-200 rounded-lg border-2 border-blue-500 cursor-pointer"></div>
                                <div class="w-16 h-16 bg-gray-300 rounded-lg border border-gray-300 cursor-pointer hover:border-gray-400"></div>
                                <div class="w-16 h-16 bg-gray-400 rounded-lg border border-gray-300 cursor-pointer hover:border-gray-400"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Product Details Section -->
                    <div class="p-8 lg:p-12 flex flex-col justify-between">
                        <div>
                            <!-- Product Title -->
                            <h1 class="elegant-heading text-4xl lg:text-5xl font-bold text-gray-900 mb-6 leading-tight">
                                {{ $product->name }}
                            </h1>

                            <!-- Rating -->
                            <div class="flex items-center mb-6">
                                <div class="flex items-center space-x-1">
                                    <i class="fas fa-star text-amber-400 text-lg"></i>
                                    <i class="fas fa-star text-amber-400 text-lg"></i>
                                    <i class="fas fa-star text-amber-400 text-lg"></i>
                                    <i class="fas fa-star text-amber-400 text-lg"></i>
                                    <i class="fas fa-star-half-alt text-amber-400 text-lg"></i>
                                </div>
                                <span class="text-gray-600 ml-2 text-sm">(4.8 • 124 reviews)</span>
                            </div>

                            <!-- Description -->
                            <div class="mb-8">
                                <h3 class="text-lg font-semibold text-gray-900 mb-3">Product Description</h3>
                                <p class="text-gray-700 leading-relaxed text-lg">
                                    {{ $product->description }}
                                </p>
                            </div>

                            <!-- Categories -->
                            @if ($product->categories->count() > 0)
                                <div class="mb-8">
                                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Categories</h3>
                                    <div class="flex flex-wrap gap-3">
                                        @foreach ($product->categories as $category)
                                            <span class="inline-block bg-gradient-to-r from-blue-100 to-blue-50 text-blue-700 text-sm font-semibold px-4 py-2 rounded-full shadow-sm border border-blue-200">
                                                <i class="fas fa-tag mr-2 text-blue-500"></i>
                                                {{ $category->name }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <!-- Availability & Price -->
                            <div class="space-y-6 mb-8">
                                <!-- Availability -->
                                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-2xl">
                                    <span class="font-semibold text-gray-700">Availability:</span>
                                    <span class="font-bold {{ $product->quantity > 0 ? 'text-green-600' : 'text-red-600' }} text-lg flex items-center">
                                        @if($product->quantity > 0)
                                            <i class="fas fa-check-circle mr-2"></i>
                                            In Stock ({{ $product->quantity }} items)
                                        @else
                                            <i class="fas fa-times-circle mr-2"></i>
                                            Out of Stock
                                        @endif
                                    </span>
                                </div>

                                <!-- Price -->
                                <div class="flex items-center justify-between p-4 bg-gradient-to-r from-green-50 to-emerald-50 rounded-2xl border border-green-100">
                                    <span class="text-xl font-semibold text-gray-700">Price:</span>
                                    <span class="text-4xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-green-600 to-emerald-600">
                                        NPR {{ number_format($product->price / 100, 2) }}
                                    </span>
                                </div>
                            </div>

                            <!-- Quantity Selector -->
                            <div class="mb-8">
                                <h3 class="text-lg font-semibold text-gray-900 mb-4">Quantity</h3>
                                <div class="flex items-center space-x-4">
                                    <div class="flex items-center border-2 border-gray-200 rounded-2xl overflow-hidden bg-white shadow-sm">
                                        <button type="button"
                                            class="quantity-btn w-14 h-14 bg-gray-50 hover:bg-gray-100 text-gray-700 text-xl flex items-center justify-center transition-all duration-200 hover:scale-105 active:scale-95"
                                            onclick="decreaseQuantity()">
                                            -
                                        </button>
                                        <input type="number" name="quantity" id="quantity-input" value="1" min="1"
                                            max="{{ $product->quantity }}"
                                            class="w-20 h-14 text-center text-xl font-bold border-none focus:outline-none focus:ring-0 bg-white">
                                        <button type="button"
                                            class="quantity-btn w-14 h-14 bg-gray-50 hover:bg-gray-100 text-gray-700 text-xl flex items-center justify-center transition-all duration-200 hover:scale-105 active:scale-95"
                                            onclick="increaseQuantity()">
                                            +
                                        </button>
                                    </div>
                                    <span class="text-sm text-gray-500">Max: {{ $product->quantity }} items</span>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="space-y-4 mt-8">
                            @if (auth()->check())
                                <!-- Add to Cart Form -->
                                <form action="{{ route('users.carts.store', ['user' => Auth::user()->id ?? null]) }}"
                                    method="POST" class="w-full">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="quantity" id="quantity-hidden" value="1">
                                    <button type="submit" {{ $product->quantity === 0 ? 'disabled' : '' }}
                                        class="w-full bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-white font-bold py-4 px-8 rounded-2xl transition-all duration-300 transform hover:scale-[1.02] active:scale-[0.98] shadow-lg hover:shadow-xl flex items-center justify-center text-lg disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none">
                                        <i class="fas fa-shopping-cart mr-3 text-lg"></i>
                                        Add to Cart
                                    </button>
                                </form>
                            @else
                                <!-- Login to Add to Cart -->
                                <a href="{{ route('login') }}"
                                    class="w-full bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-white font-bold py-4 px-8 rounded-2xl transition-all duration-300 transform hover:scale-[1.02] active:scale-[0.98] shadow-lg hover:shadow-xl flex items-center justify-center text-lg">
                                    <i class="fas fa-shopping-cart mr-3 text-lg"></i>
                                    Add to Cart
                                </a>
                            @endif

                            <!-- Buy Now & Checkout Buttons -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <button {{ $product->quantity === 0 ? 'disabled' : '' }}
                                    class="w-full bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-bold py-4 px-8 rounded-2xl transition-all duration-300 transform hover:scale-[1.02] active:scale-[0.98] shadow-lg hover:shadow-xl flex items-center justify-center text-lg disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none">
                                    <i class="fas fa-bolt mr-3 text-lg"></i>
                                    Buy Now
                                </button>

                                <!-- Checkout Button -->
                                @if (auth()->check())
                                    {{-- <form action="{{ route('checkout.create') }}" method="POST" class="w-full"> --}}
                                    <form  method="POST" class="w-full">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <input type="hidden" name="quantity" id="checkout-quantity" value="1">
                                        <button type="submit" {{ $product->quantity === 0 ? 'disabled' : '' }}
                                            class="w-full bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white font-bold py-4 px-8 rounded-2xl transition-all duration-300 transform hover:scale-[1.02] active:scale-[0.98] shadow-lg hover:shadow-xl flex items-center justify-center text-lg disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none">
                                            <i class="fas fa-credit-card mr-3 text-lg"></i>
                                            Checkout
                                        </button>
                                    </form>
                                @else
                                    <a href="{{ route('login') }}"
                                        class="w-full bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white font-bold py-4 px-8 rounded-2xl transition-all duration-300 transform hover:scale-[1.02] active:scale-[0.98] shadow-lg hover:shadow-xl flex items-center justify-center text-lg">
                                        <i class="fas fa-credit-card mr-3 text-lg"></i>
                                        Checkout
                                    </a>
                                @endif
                            </div>
                        </div>

                        <!-- Trust Badges -->
                        <div class="mt-8 pt-6 border-t border-gray-200">
                            <div class="flex flex-wrap justify-center gap-6 text-center text-gray-600">
                                <div class="flex items-center space-x-2">
                                    <i class="fas fa-shield-alt text-green-500"></i>
                                    <span class="text-sm">Secure Payment</span>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <i class="fas fa-truck text-blue-500"></i>
                                    <span class="text-sm">Free Shipping</span>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <i class="fas fa-undo text-purple-500"></i>
                                    <span class="text-sm">30-Day Return</span>
                                </div>
                            </div>
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
            const checkoutInput = document.getElementById('checkout-quantity');
            
            hiddenInput.value = quantityInput.value;
            checkoutInput.value = quantityInput.value;
        }

        // Initialize the hidden quantity fields
        document.addEventListener('DOMContentLoaded', function() {
            updateHiddenQuantities();

            // Update hidden fields when quantity input changes manually
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

    <style>
        .elegant-heading {
            font-family: 'Playfair Display', serif;
        }
        
        .quantity-btn {
            transition: all 0.2s ease;
        }
        
        input[type=number]::-webkit-outer-spin-button,
        input[type=number]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        
        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>
@endsection