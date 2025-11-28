<x-layouts.admin>
    <div class="w-full py-6 px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <a href="{{ route('admin.orders.show', ['order' => $order->id]) }}"
                class="inline-flex items-center text-blue-500 hover:text-blue-700 text-sm font-medium mb-4 transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to Order
            </a>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Edit Order #{{ $order->id }}</h1>
        </div>

        <form action="{{ route('admin.orders.update', [$order->user_id, $order->id]) }}"
            method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Order Status -->
            <div class="bg-white dark:bg-slate-900 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-6">
                <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Order Status</h2>

                <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                    @foreach (['pending', 'processed', 'completed', 'cancelled'] as $status)
                        <label
                            class="flex items-center p-4 border-2 rounded-xl cursor-pointer transition-all {{ $order->status == $status ? 'bg-blue-50 border-blue-500 ring-2 ring-blue-200' : 'border-gray-200 dark:border-slate-700 hover:bg-gray-50 dark:hover:bg-slate-700 dark:bg-slate-800 hover:border-gray-300 dark:border-gray-600' }}">
                            <input type="radio" name="status" value="{{ $status }}"
                                {{ $order->status == $status ? 'checked' : '' }}
                                class="mr-3 text-blue-600 dark:text-blue-400 focus:ring-blue-500">
                            <span class="text-gray-800 dark:text-gray-200 capitalize font-medium">{{ $status }}</span>
                        </label>
                    @endforeach
                </div>
                @error('status')
                    <p class="text-red-500 text-sm mt-3">{{ $message }}</p>
                @enderror
            </div>

            <!-- Order Items -->
            <div class="bg-white dark:bg-slate-900 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-6">
                <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Order Items</h2>

                <div class="space-y-4">
                    @foreach ($order->orderItems as $index => $item)
                        <div class="border border-gray-200 dark:border-slate-700 rounded-xl p-5 bg-gray-50 dark:bg-slate-800">
                            <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 dark:text-gray-600 mb-2">Product</label>
                                    <p class="p-3 bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-700 rounded-lg text-gray-900 dark:text-white font-medium">
                                        {{ $item->product->name }}
                                    </p>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 dark:text-gray-600 mb-2">Quantity</label>
                                    <input type="number" name="items[{{ $index }}][quantity]"
                                        value="{{ $item->quantity }}" min="1"
                                        class="w-full border border-gray-200 dark:border-slate-700 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 dark:text-gray-600 mb-2">Price (NPR)</label>
                                    <input type="number" name="items[{{ $index }}][amount_per_item]"
                                        value="{{ $item->amount_per_item*1 }}" step="0.01"
                                        min="0"
                                        class="w-full border border-gray-200 dark:border-slate-700 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                                </div>

                                <input type="hidden" name="items[{{ $index }}][id]"
                                    value="{{ $item->id }}">
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Shipping Address -->
            <div class="bg-white dark:bg-slate-900 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-6">
                <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Shipping Address</h2>

                <div class="space-y-5">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 dark:text-gray-600 mb-2">Country</label>
                            <input type="text" name="address[country]" value="{{ $order->address->country }}"
                                class="w-full border border-gray-200 dark:border-slate-700 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                            @error('address.country')
                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 dark:text-gray-600 mb-2">State</label>
                            <input type="text" name="address[state]" value="{{ $order->address->state }}"
                                class="w-full border border-gray-200 dark:border-slate-700 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                            @error('address.state')
                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 dark:text-gray-600 mb-2">City</label>
                        <input type="text" name="address[city]" value="{{ $order->address->city }}"
                            class="w-full border border-gray-200 dark:border-slate-700 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                        @error('address.city')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 dark:text-gray-600 mb-2">Street Address 1</label>
                        <input type="text" name="address[street_address_1]"
                            value="{{ $order->address->street_address_1 }}"
                            class="w-full border border-gray-200 dark:border-slate-700 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                        @error('address.street_address_1')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 dark:text-gray-600 mb-2">Street Address 2</label>
                        <input type="text" name="address[street_address_2]"
                            value="{{ $order->address->street_address_2 }}"
                            class="w-full border border-gray-200 dark:border-slate-700 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                        @error('address.street_address_2')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                    </div>
                </div>
            </div>

            <div class="flex justify-end gap-4 pt-4">
                <a href="{{ route('admin.orders.show', ['order' => $order->id]) }}"
                    class="px-6 py-3 bg-gray-300 text-gray-800 dark:text-gray-200 rounded-lg hover:bg-gray-400 font-medium transition-colors">
                    Cancel
                </a>
                <button type="submit"
                    class="px-6 py-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600 font-medium transition-colors">
                    Update Order
                </button>
            </div>
        </form>
    </div>
</x-layouts.admin>