<x-layouts.admin>
    <div class="w-full py-6 px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <a href="{{ route('admin.orders.index') }}"
                class="inline-flex items-center text-blue-500 hover:text-blue-700 text-sm font-medium mb-4 transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to Orders
            </a>
            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Order #{{ $order->id }}</h1>
                <a href="{{ route('admin.orders.edit', ['order' => $order]) }}"
                    class="inline-flex items-center px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 text-sm font-medium transition-colors">
                    Edit Order
                </a>
            </div>
        </div>

        <!-- Status Badge -->
        <div class="mb-8 text-center">
            @php
                $statusColors = [
                    'pending' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                    'processed' => 'bg-blue-100 text-blue-800 border-blue-200',
                    'completed' => 'bg-green-100 text-green-800 border-green-200',
                    'cancelled' => 'bg-red-100 text-red-800 border-red-200',
                ];
            @endphp
            <span
                class="px-6 py-2 rounded-full text-sm font-semibold border-2 {{ $statusColors[$order->status] ?? 'bg-gray-100 dark:bg-slate-800 text-gray-800 dark:text-gray-200 border-gray-200 dark:border-slate-700' }}">
                {{ ucfirst($order->status) }}
            </span>
        </div>

        <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
            <!-- Order Items -->
            <div class="xl:col-span-2 space-y-8">
                <div class="bg-white dark:bg-slate-900 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-6">
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Order Items</h2>
                    <div class="space-y-4">
                        @foreach ($order->orderItems as $item)
                            <div
                                class="flex items-center justify-between border-b border-gray-100 dark:border-gray-700 pb-4 last:border-b-0">
                                <div class="flex items-center space-x-4">
                                    @if ($item->product->images && $item->product->images->first())
                                        <img src="{{ Storage::url($item->product->images->first()->image_path) }}"
                                            alt="{{ $item->product->name }}"
                                            class="w-16 h-16 object-cover rounded-lg border border-gray-200 dark:border-slate-700">
                                    @else
                                        <div
                                            class="w-16 h-16 bg-gray-100 dark:bg-slate-800 rounded-lg border border-gray-200 dark:border-slate-700 flex items-center justify-center">
                                            <span class="text-gray-400 dark:text-gray-500 text-xs">No Image</span>
                                        </div>
                                    @endif
                                    <div>
                                        <h3 class="font-semibold text-gray-900 dark:text-white">{{ $item->product->name }}</h3>
                                        <p class="text-gray-600 dark:text-gray-300 text-sm">NPR
                                            {{ number_format($item->amount_per_item, 2) }}</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="text-gray-700 dark:text-gray-300">Qty: {{ $item->quantity }}</p>
                                    <p class="font-semibold text-gray-900 dark:text-white text-lg">
                                        NPR {{ number_format($item->amount_per_item * $item->quantity, 2) }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Total -->
                    <div class="mt-8 pt-6 border-t border-gray-200 dark:border-slate-700">
                        @php
                            $subtotal = $order->orderItems->sum(function ($item) {
                                return $item->amount_per_item * $item->quantity;
                            });
                        @endphp
                        <div class="space-y-2 mb-4">
                            <div class="flex justify-between items-center text-gray-600 dark:text-gray-300">
                                <span>Subtotal:</span>
                                <span>NPR {{ number_format($subtotal, 2) }}</span>
                            </div>
                            <div class="flex justify-between items-center text-gray-600 dark:text-gray-300">
                                <span>Tax:</span>
                                <span>NPR {{ number_format($order->tax_amount, 2) }}</span>
                            </div>
                            <div class="flex justify-between items-center text-gray-600 dark:text-gray-300">
                                <span>Service Charge:</span>
                                <span>NPR {{ number_format($order->service_charge, 2) }}</span>
                            </div>
                            <div class="flex justify-between items-center text-gray-600 dark:text-gray-300">
                                <span>Delivery Charge:</span>
                                <span>NPR {{ number_format($order->delivery_charge, 2) }}</span>
                            </div>
                        </div>
                        <div class="flex justify-between items-center font-bold text-gray-900 dark:text-white text-lg border-t border-gray-200 dark:border-slate-700 pt-4">
                            <span>Total Amount:</span>
                            <span>NPR {{ number_format($order->total, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar Info -->
            <div class="space-y-8">
                <!-- Order Info -->
                <div class="bg-white dark:bg-slate-900 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-6">
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Order Information</h2>
                    <div class="space-y-4">
                        <div>
                            <label class="text-sm text-gray-500 dark:text-gray-400 dark:text-gray-500 font-medium">Order ID</label>
                            <p class="font-semibold text-gray-900 dark:text-white">#{{ $order->id }}</p>
                        </div>
                        <div>
                            <label class="text-sm text-gray-500 dark:text-gray-400 dark:text-gray-500 font-medium">Order Date</label>
                            <p class="font-semibold text-gray-900 dark:text-white">{{ $order->created_at->format('M d, Y h:i A') }}</p>
                        </div>
                        <div>
                            <label class="text-sm text-gray-500 dark:text-gray-400 dark:text-gray-500 font-medium">Last Updated</label>
                            <p class="font-semibold text-gray-900 dark:text-white">{{ $order->updated_at->format('M d, Y h:i A') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Customer Info -->
                <div class="bg-white dark:bg-slate-900 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-6">
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Customer</h2>
                    <div class="space-y-4">
                        <div>
                            <label class="text-sm text-gray-500 dark:text-gray-400 dark:text-gray-500 font-medium">Name</label>
                            <p class="font-semibold text-gray-900 dark:text-white">{{ $order->user->name }}</p>
                        </div>
                        <div>
                            <label class="text-sm text-gray-500 dark:text-gray-400 dark:text-gray-500 font-medium">Email</label>
                            <p class="font-semibold text-blue-600 dark:text-blue-400">{{ $order->user->email }}</p>
                        </div>
                    </div>
                </div>

                <!-- Shipping Address -->
                <div class="bg-white dark:bg-slate-900 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-6">
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Shipping Address</h2>
                    <div class="space-y-3">
                        <p class="font-semibold text-gray-900 dark:text-white">{{ $order->address->street_address_1 }}</p>
                        @if ($order->address->street_address_2)
                            <p class="font-semibold text-gray-900 dark:text-white">{{ $order->address->street_address_2 }}</p>
                        @endif
                        <p class="text-gray-700 dark:text-gray-300">{{ $order->address->city }}, {{ $order->address->state }}</p>
                        <p class="text-gray-700 dark:text-gray-300">{{ $order->address->country }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.admin>