<x-layouts.user>
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50/20 py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <!-- Page Header -->
            <div class="mb-8">
                <h1 class="text-4xl font-bold text-gray-900 mb-2">Shopping Cart</h1>
                <p class="text-gray-600">Review your items and proceed to checkout</p>
            </div>

            @php
                $cartItems = $cart ? $cart->cartItems : collect();
                $grandTotal = 0;
            @endphp

            @if ($cartItems->count() > 0)
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Cart Items Section -->
                    <div class="lg:col-span-2 space-y-4">
                        @foreach ($cartItems as $cartItem)
                            @php
                                $product = $cartItem->product;
                                $itemTotal = ($product->price / 100) * $cartItem->quantity;
                                $grandTotal += $itemTotal;
                            @endphp

                            <div class="bg-white rounded-2xl shadow-sm hover:shadow-md transition-all duration-300 border border-gray-100 p-6">
                                <div class="flex flex-col sm:flex-row gap-6">
                                    <!-- Product Image -->
                                    <div class="w-full sm:w-32 h-32 flex-shrink-0">
                                        <img src="{{ $product->image_url }}" 
                                             alt="{{ $product->name }}"
                                             class="w-full h-full object-cover rounded-xl">
                                    </div>

                                    <!-- Product Details -->
                                    <div class="flex-1">
                                        <div class="flex justify-between items-start mb-3">
                                            <div>
                                                <h3 class="text-xl font-bold text-gray-900 mb-1">
                                                    <a href="{{ route('products.show', $product->id) }}" class="hover:text-blue-600 transition-colors">
                                                        {{ $product->name }}
                                                    </a>
                                                </h3>
                                                <p class="text-gray-600 text-sm line-clamp-2">{{ Str::limit($product->description, 100) }}</p>
                                            </div>
                                        </div>

                                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mt-4">
                                            <!-- Quantity and Price -->
                                            <div class="flex items-center gap-6">
                                                <div>
                                                    <span class="text-sm text-gray-500">Quantity:</span>
                                                    <span class="font-semibold text-gray-900 ml-2">{{ $cartItem->quantity }}</span>
                                                </div>
                                                <div>
                                                    <span class="text-sm text-gray-500">Price:</span>
                                                    <span class="font-semibold text-gray-900 ml-2">NPR {{ number_format($product->price / 100, 2) }}</span>
                                                </div>
                                            </div>

                                            <!-- Item Total -->
                                            <div class="text-right">
                                                <div class="text-sm text-gray-500">Subtotal</div>
                                                <div class="text-2xl font-bold text-blue-600">NPR {{ number_format($itemTotal, 2) }}</div>
                                            </div>
                                        </div>

                                        <!-- Actions -->
                                        <div class="flex gap-3 mt-4 pt-4 border-t border-gray-100">
                                            <a href="{{ route('products.show', $product->id) }}" 
                                               class="flex-1 sm:flex-none inline-flex items-center justify-center px-4 py-2 bg-blue-50 text-blue-600 text-sm rounded-lg hover:bg-blue-100 transition-colors font-medium">
                                                <svg class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                                View Product
                                            </a>
                                            <form action="{{ route('user.cart-items.destroy', $cartItem->id) }}" method="POST" class="flex-1 sm:flex-none">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="w-full inline-flex items-center justify-center px-4 py-2 bg-red-50 text-red-600 text-sm rounded-lg hover:bg-red-100 transition-colors font-medium"
                                                    onclick="return confirm('Remove this item from your cart?')">
                                                    <svg class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                    Remove
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Order Summary Sidebar -->
                    <div class="lg:col-span-1">
                        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 sticky top-24">
                            <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                                <svg class="h-6 w-6 mr-2 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                                Order Summary
                            </h2>

                            <div class="space-y-4 mb-6">
                                <div class="flex justify-between text-gray-600">
                                    <span>Total Items:</span>
                                    <span class="font-semibold">{{ $cartItems->count() }} item(s)</span>
                                </div>
                                <div class="flex justify-between text-gray-600">
                                    <span>Total Quantity:</span>
                                    <span class="font-semibold">{{ $cartItems->sum('quantity') }}</span>
                                </div>
                                <div class="flex justify-between text-gray-600">
                                    <span>Subtotal:</span>
                                    <span class="font-semibold">NPR {{ number_format($grandTotal, 2) }}</span>
                                </div>
                                <div class="flex justify-between text-gray-600">
                                    <span>Shipping:</span>
                                    <span class="font-semibold text-green-600">Free</span>
                                </div>
                            </div>

                            <div class="border-t border-gray-200 pt-4 mb-6">
                                <div class="flex justify-between items-center">
                                    <span class="text-lg font-semibold text-gray-900">Grand Total:</span>
                                    <span class="text-3xl font-bold text-blue-600">NPR {{ number_format($grandTotal, 2) }}</span>
                                </div>
                            </div>

                            <!-- Checkout Button -->
                            <a href="{{ route('carts.view-checkout', $cart->id) }}" 
                               class="w-full bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-bold py-4 px-6 rounded-xl transition-all duration-300 transform hover:scale-[1.02] active:scale-[0.98] shadow-lg hover:shadow-xl flex items-center justify-center text-lg">
                                <svg class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                </svg>
                                Proceed to Checkout
                            </a>

                            <!-- Continue Shopping -->
                            <a href="{{ route('products.index') }}" 
                               class="mt-3 w-full bg-gray-100 hover:bg-gray-200 text-gray-800 font-semibold py-3 px-6 rounded-xl transition-colors duration-300 flex items-center justify-center">
                                <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                </svg>
                                Continue Shopping
                            </a>

                            <!-- Trust Badges -->
                            <div class="mt-6 pt-6 border-t border-gray-200">
                                <div class="space-y-3 text-sm text-gray-600">
                                    <div class="flex items-center">
                                        <svg class="h-5 w-5 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                        </svg>
                                        Secure Payment
                                    </div>
                                    <div class="flex items-center">
                                        <svg class="h-5 w-5 text-blue-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0" />
                                        </svg>
                                        Free Delivery
                                    </div>
                                    <div class="flex items-center">
                                        <svg class="h-5 w-5 text-purple-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6" />
                                        </svg>
                                        Easy Returns
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <!-- Empty Cart State -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-12 text-center">
                    <div class="max-w-md mx-auto">
                        <div class="text-8xl mb-6">🛒</div>
                        <h2 class="text-3xl font-bold text-gray-900 mb-3">Your cart is empty</h2>
                        <p class="text-gray-600 mb-8 text-lg">Looks like you haven't added anything to your cart yet. Start exploring our amazing products!</p>
                        <a href="{{ route('products.index') }}" 
                           class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white rounded-xl hover:shadow-lg transition-all duration-300 font-bold text-lg transform hover:scale-105">
                            <svg class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                            </svg>
                            Start Shopping
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-layouts.user>
