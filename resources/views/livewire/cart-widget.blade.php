@if ($mode === 'logo')
    <div>
        <a href="{{ route('user.cart.index') }}" class="relative text-white hover:text-blue-100 dark:hover:text-slate-200">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
            @if ($count > 0)
                <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
                    {{ $count }}
                </span>
            @endif
        </a>
    </div>
@elseif ($mode === 'button' && $product)
    <div wire:key="cart-widget-{{ $product->id }}">
        @auth
            <form wire:submit.prevent="addToCart" class="space-y-4">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Quantity</label>
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-slate-900">
                            <button type="button" wire:click.prevent="decrease"
                                class="w-10 h-10 bg-gray-50 dark:bg-slate-800 hover:bg-gray-100 dark:hover:bg-slate-700 text-gray-700 dark:text-gray-300 font-bold flex items-center justify-center rounded-l-lg">
                                -
                            </button>
                            <input type="number" wire:model.defer="quantity" min="1" max="{{ $product->quantity }}"
                                class="w-16 h-10 text-center border-none focus:outline-none focus:ring-0 bg-transparent text-gray-900 dark:text-white appearance-none m-0">
                            <button type="button" wire:click.prevent="increase"
                                class="w-10 h-10 bg-gray-50 dark:bg-slate-800 hover:bg-gray-100 dark:hover:bg-slate-700 text-gray-700 dark:text-gray-300 font-bold flex items-center justify-center rounded-r-lg">
                                +
                            </button>
                        </div>
                        <span class="text-sm text-gray-500 dark:text-gray-400">Max: {{ $product->quantity }}</span>
                    </div>
                </div>

                <div>
                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-4 rounded">
                        <span wire:loading.remove> Add to Cart </span>
                        <span wire:loading> Adding... </span>
                    </button>
                </div>
            </form>
        @else
            <a href="{{ route('login') }}" class="w-full block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-4 rounded text-center">Login to add to cart</a>
        @endauth

        @if (session()->has('success'))
            <div class="mt-3 text-sm text-green-600">{{ session('success') }}</div>
        @endif
        @if (session()->has('error'))
            <div class="mt-3 text-sm text-red-600">{{ session('error') }}</div>
        @endif
    </div>
@endif
