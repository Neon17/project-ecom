<div id="user-cart-modal" class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50 hidden p-4">
    <div
        class="bg-white rounded-2xl shadow-2xl relative w-full max-w-2xl max-h-[90vh] flex flex-col transform transition-all duration-300 data-[state=open]:scale-100 data-[state=open]:opacity-100 data-[state=closed]:scale-95 data-[state=closed]:opacity-0">
        <!-- Header -->
        <div class="flex justify-between items-center p-6 border-b border-gray-200 bg-gray-50 rounded-t-2xl">
            <h2 class="text-3xl font-bold text-gray-900 flex items-center">
                <svg class="h-8 w-8 mr-3 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                Shopping Cart
            </h2>
            <button id="close-user-cart-modal"
                class="text-gray-500 hover:text-gray-900 transition-colors duration-200 text-3xl leading-none p-2 rounded-full hover:bg-gray-100">
                &times;
            </button>
        </div>

        <!-- Cart Content -->
        <div class="p-6 flex-1 overflow-y-auto">
            @php
                $cart = auth()->user()?->cart;
                $cartItems = $cart ? $cart->cartItems : collect();
                $grandTotal = 0;
            @endphp

            @if ($cartItems->count() > 0)
                <div class="space-y-6">
                    @foreach ($cartItems as $cartItem)
                        @php
                            $product = $cartItem->product;
                            $itemTotal = ($product->price / 100) * $cartItem->quantity;
                            $grandTotal += $itemTotal;
                        @endphp

                        <div
                            class="bg-white rounded-lg border border-gray-200 p-4 shadow-sm hover:shadow-md transition-shadow duration-200 flex items-center space-x-4">
                            <!-- Product Image -->
                            @if ($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                    class="w-24 h-24 object-cover rounded-md border border-gray-100">
                            @else
                                <div
                                    class="w-24 h-24 bg-gray-100 rounded-md border border-gray-100 flex items-center justify-center text-gray-400 text-xs">
                                    No Image
                                </div>
                            @endif

                            <!-- Product Info -->
                            <div class="flex-1">
                                <h3 class="text-xl font-semibold text-gray-900 mb-1">{{ $product->name }}</h3>
                                <p class="text-gray-600 text-sm mb-2">Price: NPR {{ number_format($product->price / 100, 2) }}</p>
                                <div class="flex items-center space-x-4">
                                    <span class="font-medium text-gray-700">Quantity: {{ $cartItem->quantity }}</span>
                                    <span class="font-bold text-lg text-blue-600">Total: NPR {{ number_format($itemTotal, 2) }}</span>
                                </div>
                            </div>

                            <!-- Actions -->
                            <div class="flex flex-col space-y-2">
                                <a href="{{ route('products.show', ['product' => $product->id]) }}"
                                    class="inline-flex items-center justify-center px-3 py-2 bg-blue-600 text-white text-sm rounded-md hover:bg-blue-700 transition-colors duration-200 font-medium w-full">
                                    <svg class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    View
                                </a>
                                <form action="{{ route('users.carts.destroy', ['cart' => $cartItem->id, 'user' => auth()->id()]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="inline-flex items-center justify-center px-3 py-2 bg-red-600 text-white text-sm rounded-md hover:bg-red-700 transition-colors duration-200 font-medium w-full"
                                        onclick="return confirm('Are you sure you want to remove this item from your cart?')">
                                        <svg class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        Remove
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- Empty Cart State -->
                <div class="text-center py-20">
                    <div class="text-7xl mb-6 text-gray-300">🛒</div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-3">Your shopping cart is empty!</h3>
                    <p class="text-gray-600 mb-8 text-lg">Looks like you haven't added anything to your cart yet. Start exploring our products!</p>
                    <a href="{{ route('products.index') }}"
                        class="px-8 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200 font-bold text-lg shadow-md">
                        Start Shopping
                    </a>
                </div>
            @endif
        </div>

        <!-- Cart Summary & Action Buttons (Footer) -->
        @if ($cartItems->count() > 0)
            <div class="p-6 border-t border-gray-200 bg-gray-50 rounded-b-2xl">
                <div class="flex justify-between items-center mb-4">
                    <span class="font-semibold text-gray-700 text-lg">Total Items:</span>
                    <span class="font-bold text-gray-900 text-xl">{{ $cartItems->count() }}</span>
                </div>
                <div class="flex justify-between items-center text-xl font-bold border-t border-gray-200 pt-4 mt-4 mb-6">
                    <span class="text-gray-800">Grand Total:</span>
                    <span class="text-green-600 text-2xl">NPR {{ number_format($grandTotal, 2) }}</span>
                </div>

                <!-- Place Order Button -->
                <div class="text-center">
                    
                        <a href="{{route('carts.view-checkout', $cart->id)}}" type="submit"
                            class="px-8 py-4 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors duration-200 font-bold text-xl w-full shadow-lg">
                            <svg class="h-6 w-6 mr-3 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M10 12H7.99" />
                            </svg>
                            Place Order
                        </a>
                </div>
            </div>
        @endif
    </div>
</div>
