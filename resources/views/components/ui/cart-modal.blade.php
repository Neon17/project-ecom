<div id="user-cart-modal" class="p-3 py-20 top-0 fixed left-1/3 w-1/3 min-h-screen z-50 hidden">
    <div class="p-5 w-full h-full bg-amber-50 shadow-lg overflow-y-auto">
        <div class="title text-2xl p-3 text-center flex items-center">
            <h2 class="flex-1 text-center">Cart</h2>
            <button id="close-user-cart-modal" class="hover:cursor-pointer text-gray-700">
                X
            </button>
        </div>

        @php
            $cart = auth()->user()->cart;
            $cartItems = $cart ? $cart->cartItems : collect();
        @endphp

        @if ($cartItems->count() > 0)
            <div class="space-y-4 my-6">
                @foreach ($cartItems as $index => $cartItem)
                    <div
                        class="bg-white rounded-lg shadow-md border border-gray-200 p-4 hover:shadow-lg transition-all duration-300">
                        <div class="flex justify-between items-start mb-3">
                            <h3 class="text-lg font-semibold text-gray-800">{{ $cartItem->name }}</h3>
                            <span class="text-lg font-bold text-green-600">${{ $cartItem->price }}</span>
                        </div>

                        <div class="grid grid-cols-2 gap-2 mb-3 text-sm text-gray-600">
                            <div>
                                <span class="font-medium">Quantity:</span>
                                <span class="ml-2 bg-amber-100 px-2 py-1 rounded">{{ $cartItem->quantity }}</span>
                            </div>
                            <div>
                                <span class="font-medium">Total:</span>
                                <span class="ml-2 font-semibold">${{ $cartItem->price * $cartItem->quantity }}</span>
                            </div>
                        </div>

                        @if ($cartItem->description)
                            <div class="mb-3">
                                <p class="text-sm text-gray-700">
                                    <span class="font-medium">Description:</span>
                                    {{ $cartItem->description }}
                                </p>
                            </div>
                        @endif

                        <div class="flex justify-end space-x-2 pt-3 border-t border-gray-100">
                            <a href="{{ route('users.carts.edit', ['cart' => $cartItem->id, 'user' => auth()->id()]) }}"
                                class="px-3 py-2 bg-yellow-500 text-white text-sm rounded hover:bg-yellow-600 transition-all duration-300">
                                Edit
                            </a>
                            <a href="{{ route('users.carts.show', ['cart' => $cartItem->id, 'user' => auth()->id()]) }}"
                                class="px-3 py-2 bg-blue-500 text-white text-sm rounded hover:bg-blue-600 transition-all duration-300">
                                View
                            </a>
                            <button
                                class="open-delete-modal px-3 py-2 bg-red-500 text-white text-sm rounded hover:bg-red-600 transition-all duration-300">
                                Delete
                            </button>
                            <x-ui.delete-modal
                                action="{{ route('users.carts.destroy', ['cart' => $cartItem->id, 'user' => auth()->id()]) }}" />
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Cart Summary -->
            <div class="bg-white rounded-lg shadow-md border border-gray-200 p-4 mt-6">
                <div class="flex justify-between items-center mb-2">
                    <span class="font-semibold">Total Items:</span>
                    <span class="font-bold">{{ $cartItems->count() }}</span>
                </div>
                <div class="flex justify-between items-center text-lg">
                    <span class="font-semibold">Grand Total:</span>
                    <span class="font-bold text-green-600">
                        ${{ $cartItems->sum(function ($item) {return $item->price * $item->quantity;}) }}
                    </span>
                </div>
            </div>
        @else
            <div class="p-8 text-center bg-white rounded-lg shadow-md border border-gray-200 mt-8">
                <div class="text-gray-400 mb-4">
                    <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
                        </path>
                    </svg>
                </div>
                <p class="text-xl text-gray-600 mb-2">Your cart is empty</p>
                <p class="text-gray-500">Add some items to get started!</p>
            </div>
        @endif
    </div>
</div>
