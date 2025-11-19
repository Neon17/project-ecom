{{-- Clean Order Show Page --}}
<x-layouts.admin>
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-6">
            <a href="{{ route('admin.orders.index') }}"
                class="inline-flex items-center text-blue-600 hover:text-blue-800 text-sm font-medium mb-4">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to Orders
            </a>
            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-bold text-gray-900">Order #{{ $order->id }}</h1>
                <a href="{{ route('users.orders.edit', ['order' => $order, 'user' => $order->user]) }}"
                    class="inline-flex items-center px-3 py-1 bg-blue-600 text-white rounded-md hover:bg-blue-700 text-sm">
                    Edit Order
                </a>
            </div>
        </div>

        <!-- Status Badge -->
        <div class="mb-6 text-center">
            @php
                $statusColors = [
                    'pending' => 'bg-yellow-100 text-yellow-800',
                    'processed' => 'bg-blue-100 text-blue-800',
                    'completed' => 'bg-green-100 text-green-800',
                    'cancelled' => 'bg-red-100 text-red-800',
                ];
            @endphp
            <span
                class="px-4 py-1 rounded-full text-sm font-medium {{ $statusColors[$order->status] ?? 'bg-gray-100 text-gray-800' }}">
                {{ ucfirst($order->status) }}
            </span>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Order Items -->
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white rounded-lg border border-gray-200 p-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Order Items</h2>
                    <div class="space-y-4">
                        @foreach ($order->orderItems as $item)
                            <div
                                class="flex items-center justify-between border-b border-gray-100 pb-4 last:border-b-0">
                                <div class="flex items-center space-x-3">
                                    @if ($item->product->images && $item->product->images->first())
                                        <img src="{{ Storage::url($item->product->images->first()->image_path) }}"
                                            alt="{{ $item->product->name }}"
                                            class="w-16 h-16 object-cover rounded-md border border-gray-200">
                                    @else
                                        <div
                                            class="w-16 h-16 bg-gray-100 rounded-md border border-gray-200 flex items-center justify-center">
                                            <span class="text-gray-400 text-xs">No Image</span>
                                        </div>
                                    @endif
                                    <div>
                                        <h3 class="font-medium text-gray-900">{{ $item->product->name }}</h3>
                                        <p class="text-gray-600 text-sm">NPR
                                            {{ number_format($item->amount_per_item / 100, 2) }}</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="text-gray-700">Qty: {{ $item->quantity }}</p>
                                    <p class="font-medium text-gray-900">
                                        NPR {{ number_format(($item->amount_per_item / 100) * $item->quantity, 2) }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Total -->
                    <div class="mt-6 pt-4 border-t border-gray-200">
                        @php
                            $totalAmount = $order->orderItems->sum(function ($item) {
                                return ($item->amount_per_item / 100) * $item->quantity;
                            });
                        @endphp
                        <div class="flex justify-between items-center font-bold text-gray-900">
                            <span>Total Amount:</span>
                            <span>NPR {{ number_format($totalAmount, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar Info -->
            <div class="space-y-6">
                <!-- Order Info -->
                <div class="bg-white rounded-lg border border-gray-200 p-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Order Information</h2>
                    <div class="space-y-3">
                        <div>
                            <label class="text-xs text-gray-500">Order ID</label>
                            <p class="font-medium text-gray-900">#{{ $order->id }}</p>
                        </div>
                        <div>
                            <label class="text-xs text-gray-500">Order Date</label>
                            <p class="font-medium text-gray-900">{{ $order->created_at->format('M d, Y h:i A') }}</p>
                        </div>
                        <div>
                            <label class="text-xs text-gray-500">Last Updated</label>
                            <p class="font-medium text-gray-900">{{ $order->updated_at->format('M d, Y h:i A') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Customer Info -->
                <div class="bg-white rounded-lg border border-gray-200 p-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Customer</h2>
                    <div class="space-y-3">
                        <div>
                            <label class="text-xs text-gray-500">Name</label>
                            <p class="font-medium text-gray-900">{{ $order->user->name }}</p>
                        </div>
                        <div>
                            <label class="text-xs text-gray-500">Email</label>
                            <p class="font-medium text-blue-600">{{ $order->user->email }}</p>
                        </div>
                    </div>
                </div>

                <!-- Shipping Address -->
                <div class="bg-white rounded-lg border border-gray-200 p-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Shipping Address</h2>
                    <div class="space-y-2">
                        <p class="font-medium text-gray-900 text-sm">{{ $order->address->street_address_1 }}</p>
                        @if ($order->address->street_address_2)
                            <p class="font-medium text-gray-900 text-sm">{{ $order->address->street_address_2 }}</p>
                        @endif
                        <p class="text-gray-700 text-sm">{{ $order->address->city }}, {{ $order->address->state }}</p>
                        <p class="text-gray-700 text-sm">{{ $order->address->country }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.admin>
