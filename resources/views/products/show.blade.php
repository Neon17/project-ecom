@extends('components.layouts.guest')


@section('content')
    <div class="container mx-auto px-4 py-8 max-w-4xl">
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="md:flex">

                <div class="md:w-1/2 p-6 flex items-center justify-center">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                        class="w-full h-auto max-h-96 object-contain rounded-lg">
                </div>

                <div class="md:w-1/2 p-6">
                    <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $product->name }}</h1>

                    <div class="mb-6">
                        <p class="text-gray-600 leading-relaxed">{{ $product->description }}</p>
                    </div>

                    @if ($product->categories->count() > 0)
                        <div class="mb-4">
                            <span class="font-medium text-gray-700">Category: </span>
                            @foreach ($product->categories as $category)
                                <span
                                    class="inline-block bg-gray-100 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">
                                    {{ $category->name }}
                                </span>
                            @endforeach
                        </div>
                    @endif

                    <div class="mb-4">
                        <span class="font-medium text-gray-700">Available: </span>
                        <span class="{{ $product->quantity > 0 ? 'text-green-600' : 'text-red-600' }} font-semibold">
                            {{ $product->quantity }} {{ $product->quantity == 1 ? 'item' : 'items' }}
                        </span>
                    </div>

                    <div class="mb-6">
                        <span class="text-2xl font-bold text-gray-900">NPR
                            {{ number_format($product->price / 100, 2) }}</span>
                    </div>

                    <div class="mb-6">
                        <span class="font-medium text-gray-700 block mb-2">Quantity:</span>
                        <div class="flex items-center">
                            <button type="button"
                                class="quantity-btn w-10 h-10 rounded-l-lg border border-gray-300 flex items-center justify-center"
                                onclick="decreaseQuantity()">
                                <i class="fas fa-minus text-gray-600"></i>
                            </button>
                            <input type="number" name="quantity" id="quantity-input" value="1" min="1"
                                max="{{ $product->quantity }}"
                                class="w-16 h-10 border-t border-b border-gray-300 text-center focus:outline-none">
                            <button type="button"
                                class="quantity-btn w-10 h-10 rounded-r-lg border border-gray-300 flex items-center justify-center"
                                onclick="increaseQuantity()">
                                <i class="fas fa-plus text-gray-600"></i>
                            </button>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-4">
                        @if (auth()->check())
                            <form action="{{ route('users.carts.store', ['user' => Auth::user()->id ?? null]) }}"
                                method="POST" class="flex-1">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="quantity" id="quantity-hidden" value="1">
                                <button type="submit"
                                    class="w-full bg-yellow-500 hover:bg-yellow-600 text-white font-medium py-3 px-6 rounded-lg transition duration-300 flex items-center justify-center">
                                    <i class="fas fa-shopping-cart mr-2"></i>
                                    Add to Cart
                                </button>
                            </form>
                        @else
                            <div class="flex-1">
                                <a href="{{ route('login') }}"
                                    class="w-full bg-yellow-500 hover:bg-yellow-600 text-white font-medium py-3 px-6 rounded-lg transition duration-300 flex items-center justify-center">
                                    <i class="fas fa-shopping-cart mr-2"></i>
                                    Add to Cart
                                </a>
                            </div>
                        @endif

                        <button
                            class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-6 rounded-lg transition duration-300 flex items-center justify-center">
                            <i class="fas fa-bolt mr-2"></i>
                            Buy Now
                        </button>
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
                updateHiddenQuantity();
            }
        }

        function decreaseQuantity() {
            const quantityInput = document.getElementById('quantity-input');
            let currentValue = parseInt(quantityInput.value);

            if (currentValue > 1) {
                quantityInput.value = currentValue - 1;
                updateHiddenQuantity();
            }
        }

        function updateHiddenQuantity() {
            const quantityInput = document.getElementById('quantity-input');
            const hiddenInput = document.getElementById('quantity-hidden');
            hiddenInput.value = quantityInput.value;
        }

        // Initialize the hidden quantity field
        document.addEventListener('DOMContentLoaded', function() {
            updateHiddenQuantity();

            // Update hidden field when quantity input changes manually
            document.getElementById('quantity-input').addEventListener('change', function() {
                const maxQuantity = parseInt(this.getAttribute('max'));
                const minQuantity = parseInt(this.getAttribute('min'));
                let value = parseInt(this.value);

                if (isNaN(value) || value < minQuantity) {
                    this.value = minQuantity;
                } else if (value > maxQuantity) {
                    this.value = maxQuantity;
                }

                updateHiddenQuantity();
            });
        });
    </script>

@endsection
