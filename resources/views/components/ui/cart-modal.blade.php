<div id="user-cart-modal" class="fixed top-0 left-0 w-full h-full bg-black bg-opacity-50 z-50 hidden">
    <div
        class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-full max-w-2xl max-h-[90vh] overflow-hidden">
        <div class="bg-amber-50 rounded-lg shadow-xl m-4">
            <!-- Header -->
            <div class="flex justify-between items-center p-6 border-b border-amber-200">
                <h2 class="text-2xl font-bold text-gray-800">Shopping Cart</h2>
                <button id="close-user-cart-modal"
                    class="text-gray-500 hover:text-gray-700 transition-colors duration-200 text-xl font-semibold">
                    Close
                </button>
            </div>

            <!-- Cart Content -->
            <div class="p-6 max-h-[60vh] overflow-y-auto">
                @php
                    $cart = auth()->user()?->cart;
                    $cartItems = $cart ? $cart->cartItems : collect();
                    $grandTotal = 0;
                @endphp

                @if ($cartItems->count() > 0)
                    <div class="space-y-4">
                        @foreach ($cartItems as $cartItem)
                            @php
                                $product = $cartItem->product;
                                $itemTotal = $product->price/100 * $cartItem->quantity;
                                $grandTotal += $itemTotal;
                            @endphp

                            <div
                                class="bg-white rounded-lg border border-amber-100 p-4 hover:shadow-md transition-shadow duration-200">
                                <!-- Product Header -->
                                <div class="flex justify-between items-start mb-3">
                                    <h3 class="text-lg font-semibold text-gray-800">{{ $product->name }}</h3>
                                    <span
                                        class="text-lg font-bold text-green-600">{{ number_format($product->price / 100, 2) }}
                                        NPR</span>
                                </div>

                                <!-- Product Details -->
                                <div class="grid grid-cols-2 gap-4 mb-3 text-sm">
                                    <div class="flex items-center">
                                        <span class="font-medium text-gray-600 mr-2">Quantity:</span>
                                        <span
                                            class="bg-amber-100 px-3 py-1 rounded-full font-semibold">{{ $cartItem->quantity }}</span>
                                    </div>
                                    <div class="flex items-center">
                                        <span class="font-medium text-gray-600 mr-2">Total:</span>
                                        <span class="font-semibold text-gray-800">{{ number_format($itemTotal, 2) }}
                                            NPR</span>
                                    </div>
                                </div>

                                @if ($product->description)
                                    <div class="mb-3">
                                        <p class="text-sm text-gray-600 leading-relaxed">
                                            {{ \Illuminate\Support\Str::limit($product->description, 120) }}
                                        </p>
                                    </div>
                                @endif

                                <!-- Actions -->
                                <div class="flex justify-end space-x-3 pt-3 border-t border-gray-100">
                                    <a href="{{ route('products.show', ['product' => $product->id]) }}"
                                        class="px-4 py-2 bg-blue-500 text-white text-sm rounded-lg hover:bg-blue-600 transition-colors duration-200 font-medium">
                                        View
                                    </a>
                                    <x-ui.delete-modal
                                        action="{{ route('users.carts.destroy', ['cart' => $cartItem->id, 'user' => auth()->id()]) }}" />
                                    <form action="{{ route('cart-items.destroy', $cartItem->id) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="px-4 py-2 bg-red-500 text-white text-sm rounded-lg hover:bg-red-600 transition-colors duration-200 font-medium"
                                            onclick="return confirm('Are you sure you want to remove this item?')">
                                            Remove
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Cart Summary -->
                    <div class="bg-white rounded-lg border border-amber-100 p-6 mt-6">
                        <div class="flex justify-between items-center mb-3">
                            <span class="font-semibold text-gray-700">Total Items:</span>
                            <span class="font-bold text-gray-800">{{ $cartItems->count() }}</span>
                        </div>
                        <div class="flex justify-between items-center text-lg pt-3 border-t border-gray-200 mb-4">
                            <span class="font-semibold text-gray-800">Grand Total:</span>
                            <span class="font-bold text-green-600">{{ number_format($grandTotal, 2) }} NPR</span>
                        </div>

                        <!-- Place Order Button -->
                        <div class="text-center mt-4">
                            <form action="{{ route('users.orders.store', auth()->id()) }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="px-8 py-3 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors duration-200 font-medium text-lg w-full">
                                    Place Order
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <!-- Empty Cart State -->
                    <div class="text-center py-12">
                        <div class="text-6xl mb-4 text-amber-300">🛒</div>
                        <h3 class="text-xl font-semibold text-gray-700 mb-2">Your cart is empty</h3>
                        <p class="text-gray-500 mb-6">Add some items to get started with your shopping!</p>
                        <a href="{{ route('products.index') }}"
                            class="px-6 py-3 bg-amber-500 text-white rounded-lg hover:bg-amber-600 transition-colors duration-200 font-medium">
                            Continue Shopping
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
