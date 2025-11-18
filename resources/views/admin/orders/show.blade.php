<x-layouts.admin>

    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Order Details</h1>
            <div class="flex gap-2">
                <a href="{{ route('admin.orders.index') }}"
                    class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                    ← Back to Orders
                </a>
                <a href="{{ route('users.orders.edit', ['order' => $order, 'user' => $order->user]) }}"
                    class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    Edit Order
                </a>
            </div>
        </div>

        <!-- Status Badge -->
        <div class="mb-6">
            @php
                $statusColors = [
                    'pending' => 'bg-yellow-100 text-yellow-800 border border-yellow-200',
                    'processed' => 'bg-blue-100 text-blue-800 border border-blue-200',
                    'completed' => 'bg-green-100 text-green-800 border border-green-200',
                    'cancelled' => 'bg-red-100 text-red-800 border border-red-200',
                ];
            @endphp
            <span class="px-4 py-2 rounded-full text-sm font-medium {{ $statusColors[$order->status] }}">
                Status: {{ ucfirst($order->status) }}
            </span>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Left Column -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Order Items -->
                <div class="bg-white rounded-lg shadow border border-gray-200">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-semibold">Order Items</h2>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            @foreach ($order->orderItems as $item)
                                <div class="flex justify-between items-center border-b border-gray-100 pb-4">
                                    <div class="flex items-center space-x-4">
                                        @if ($item->product->images && $item->product->images->first())
                                            <img src="{{ Storage::url($item->product->images->first()->image_path) }}"
                                                alt="{{ $item->product->name }}"
                                                class="w-16 h-16 object-cover rounded border">
                                        @else
                                            <div
                                                class="w-16 h-16 bg-gray-200 rounded border flex items-center justify-center">
                                                <span class="text-gray-400 text-xs">No Image</span>
                                            </div>
                                        @endif
                                        <div>
                                            <h3 class="font-medium text-gray-900">{{ $item->product->name }}</h3>
                                            <p class="text-gray-500 text-sm">Price: Rs
                                                {{ number_format($item->amount_per_item / 100, 2) }}</p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-gray-600">Qty: {{ $item->quantity }}</p>
                                        <p class="font-semibold text-gray-900">
                                            Rs. {{ number_format(($item->amount_per_item/100 * $item->quantity) / 100, 2) }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Total -->
                        <div class="mt-6 pt-4 border-t border-gray-200">
                            @php
                                $totalAmount = $order->orderItems->sum(function ($item) {
                                    return $item->amount_per_item/100 * $item->quantity;
                                });
                            @endphp
                            <div class="flex justify-between items-center text-lg font-semibold">
                                <span>Total Amount:</span>
                                <span>Rs. {{ number_format($totalAmount / 100, 2) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div class="space-y-6">
                <!-- Order Information -->
                <div class="bg-white rounded-lg shadow border border-gray-200">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-semibold">Order Information</h2>
                    </div>
                    <div class="p-6 space-y-4">
                        <div>
                            <label class="text-sm text-gray-500">Order ID</label>
                            <p class="font-medium">#{{ $order->id }}</p>
                        </div>
                        <div>
                            <label class="text-sm text-gray-500">Order Date</label>
                            <p class="font-medium">{{ $order->created_at->format('M d, Y h:i A') }}</p>
                        </div>
                        <div>
                            <label class="text-sm text-gray-500">Last Updated</label>
                            <p class="font-medium">{{ $order->updated_at->format('M d, Y h:i A') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Customer Information -->
                <div class="bg-white rounded-lg shadow border border-gray-200">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-semibold">Customer Information</h2>
                    </div>
                    <div class="p-6 space-y-4">
                        <div>
                            <label class="text-sm text-gray-500">Customer Name</label>
                            <p class="font-medium">{{ $order->user->name }}</p>
                        </div>
                        <div>
                            <label class="text-sm text-gray-500">Email</label>
                            <p class="font-medium">{{ $order->user->email }}</p>
                        </div>
                    </div>
                </div>

                <!-- Shipping Address -->
                <div class="bg-white rounded-lg shadow border border-gray-200">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-semibold">Shipping Address</h2>
                    </div>
                    <div class="p-6 space-y-3">
                        <p class="font-medium">{{ $order->address->street_address_1 }}</p>
                        @if ($order->address->street_address_2)
                            <p class="font-medium">{{ $order->address->street_address_2 }}</p>
                        @endif
                        <p class="text-gray-600">{{ $order->address->city }}, {{ $order->address->state }}</p>
                        <p class="text-gray-600">{{ $order->address->country }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.admin>
