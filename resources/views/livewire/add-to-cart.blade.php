<div>
    @auth
        <form wire:submit.prevent="addToCart" class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Quantity</label>
                <div class="flex items-center mt-2">
                    <button type="button" wire:click.prevent="decrease" class="px-3 py-1 bg-gray-100 dark:bg-slate-800 rounded-l">-</button>
                    <input type="number" wire:model.defer="quantity" min="1" max="{{ $product->quantity }}" class="w-20 text-center border-t border-b border-gray-200 dark:border-gray-700" />
                    <button type="button" wire:click.prevent="increase" class="px-3 py-1 bg-gray-100 dark:bg-slate-800 rounded-r">+</button>
                    <span class="ml-4 text-sm text-gray-500 dark:text-gray-400">Max: {{ $product->quantity }}</span>
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
    @if (session()->has('success'))
        <div class="mt-3 text-sm text-green-600">{{ session('success') }}</div>
    @endif
    @if (session()->has('error'))
        <div class="mt-3 text-sm text-red-600">{{ session('error') }}</div>
    @endif
</div>

