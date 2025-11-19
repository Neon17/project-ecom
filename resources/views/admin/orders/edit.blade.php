{{-- Clean Order Edit Form --}}
<x-layouts.admin>
    <div class="max-w-4xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-6">
            <a href="{{ route('users.orders.show', [$order->user_id, $order->id]) }}"
                class="inline-flex items-center text-blue-600 hover:text-blue-800 text-sm font-medium mb-4">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to Order
            </a>
            <h1 class="text-2xl font-bold text-gray-900">Edit Order #{{ $order->id }}</h1>
        </div>

        <form action="{{ route('users.orders.update', ['user' => $order->user_id, 'order' => $order->id]) }}"
            method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Order Status -->
            <div class="bg-white rounded-lg border border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Order Status</h2>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                    @foreach (['pending', 'processed', 'completed', 'cancelled'] as $status)
                        <label
                            class="flex items-center p-3 border rounded-md cursor-pointer {{ $order->status == $status ? 'bg-blue-50 border-blue-500' : 'border-gray-300 hover:bg-gray-50' }}">
                            <input type="radio" name="status" value="{{ $status }}"
                                {{ $order->status == $status ? 'checked' : '' }}
                                class="mr-2 text-blue-600 focus:ring-blue-500">
                            <span class="text-gray-800 capitalize text-sm">{{ $status }}</span>
                        </label>
                    @endforeach
                </div>
                @error('status')
                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Order Items -->
            <div class="bg-white rounded-lg border border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Order Items</h2>

                <div class="space-y-4">
                    @foreach ($order->orderItems as $index => $item)
                        <div class="border border-gray-200 rounded-md p-4 bg-gray-50">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div>
                                    <label class="block text-xs font-medium text-gray-700 mb-1">Product</label>
                                    <p class="p-2 bg-white border border-gray-300 rounded text-gray-900 text-sm">
                                        {{ $item->product->name }}
                                    </p>
                                </div>

                                <div>
                                    <label class="block text-xs font-medium text-gray-700 mb-1">Quantity</label>
                                    <input type="number" name="items[{{ $index }}][quantity]"
                                        value="{{ $item->quantity }}" min="1"
                                        class="w-full border border-gray-300 rounded-md px-2 py-1 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500">
                                </div>

                                <div>
                                    <label class="block text-xs font-medium text-gray-700 mb-1">Price (NPR)</label>
                                    <input type="number" name="items[{{ $index }}][amount_per_item]"
                                        value="{{ $item->amount_per_item*1/100 }}" step="0.01"
                                        min="0"
                                        class="w-full border border-gray-300 rounded-md px-2 py-1 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500">
                                </div>

                                <input type="hidden" name="items[{{ $index }}][id]"
                                    value="{{ $item->id }}">
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Shipping Address -->
            <div class="bg-white rounded-lg border border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Shipping Address</h2>

                <div class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Country</label>
                            <input type="text" name="address[country]" value="{{ $order->address->country }}"
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500">
                            @error('address.country')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">State</label>
                            <input type="text" name="address[state]" value="{{ $order->address->state }}"
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500">
                            @error('address.state')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">City</label>
                        <input type="text" name="address[city]" value="{{ $order->address->city }}"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500">
                        @error('address.city')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Street Address 1</label>
                        <input type="text" name="address[street_address_1]"
                            value="{{ $order->address->street_address_1 }}"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500">
                        @error('address.street_address_1')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Street Address 2</label>
                        <input type="text" name="address[street_address_2]"
                            value="{{ $order->address->street_address_2 }}"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500">
                        @error('address.street_address_2')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="flex justify-end gap-3 pt-2">
                <a href="{{ route('users.orders.show', [$order->user_id, $order->id]) }}"
                    class="px-4 py-2 bg-gray-300 text-gray-800 rounded-md hover:bg-gray-400 font-medium">
                    Cancel
                </a>
                <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 font-medium">
                    Update Order
                </button>
            </div>
        </form>
    </div>
</x-layouts.admin>
