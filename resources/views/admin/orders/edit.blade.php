<x-layouts.admin>
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Edit Order #{{ $order->id }}</h1>
            <a href="{{ route('users.orders.show', [$order->user_id, $order->id]) }}"
                class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                ← Back to Order
            </a>
        </div>

        <form action="{{ route('users.orders.update', ['user' => $order->user_id, 'order' => $order->id]) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Order Status -->
            <div class="bg-white rounded-lg shadow border border-gray-200 p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Order Status</h2>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @foreach (['pending', 'processed', 'completed', 'cancelled'] as $status)
                        <label class="flex items-center">
                            <input type="radio" name="status" value="{{ $status }}"
                                {{ $order->status == $status ? 'checked' : '' }}
                                class="mr-2 text-blue-600 focus:ring-blue-500">
                            <span class="text-gray-700 capitalize">{{ $status }}</span>
                        </label>
                    @endforeach
                </div>
                @error('status')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Order Items -->
            <div class="bg-white rounded-lg shadow border border-gray-200 p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Order Items</h2>

                <div class="space-y-4">
                    @foreach ($order->orderItems as $index => $item)
                        <div class="border border-gray-200 rounded-lg p-4 bg-gray-50">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Product</label>
                                    <p class="p-2 bg-white border border-gray-300 rounded text-gray-900">
                                        {{ $item->product->name }}
                                    </p>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Quantity</label>
                                    <input type="number" name="items[{{ $index }}][quantity]"
                                        value="{{ $item->quantity }}" min="1"
                                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Price per Item (Paisa Not Rs.)</label>
                                    <input type="number" name="items[{{ $index }}][amount_per_item]"
                                        value="{{$item->amount_per_item*1/100}}" step="0.01"
                                        min="0"
                                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                </div>

                                <input type="hidden" name="items[{{ $index }}][id]" value="{{ $item->id }}">
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="bg-white rounded-lg shadow border border-gray-200 p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Shipping Address</h2>

                <div class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Country</label>
                            <input type="text" name="address[country]" value="{{ $order->address->country }}"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            @error('address.country')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">State</label>
                            <input type="text" name="address[state]" value="{{ $order->address->state }}"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            @error('address.state')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">City</label>
                        <input type="text" name="address[city]" value="{{ $order->address->city }}"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('address.city')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Street Address 1</label>
                        <input type="text" name="address[street_address_1]"
                            value="{{ $order->address->street_address_1 }}"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('address.street_address_1')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Street Address 2 (Optional)</label>
                        <input type="text" name="address[street_address_2]"
                            value="{{ $order->address->street_address_2 }}"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('address.street_address_2')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="flex justify-end gap-4">
                <a href="{{ route('users.orders.show', [$order->user_id, $order->id]) }}"
                    class="bg-gray-500 text-white px-6 py-3 rounded hover:bg-gray-600">
                    Cancel
                </a>
                <button type="submit" class="bg-blue-500 text-white px-6 py-3 rounded hover:bg-blue-600">
                    Update Order
                </button>
            </div>
        </form>
    </div>
</x-layouts.admin>
