<x-layouts.admin>
    <div class="py-8">
        
        <!-- Simple Header -->
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-800">Dashboard Overview</h1>
        </div>

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                {{ session('error') }}
            </div>
        @endif

        <!-- Stats Section -->
        <div class="mb-8">
            <h2 class="text-lg font-semibold text-gray-700 mb-4">Quick Stats</h2>
            
            <div class="flex flex-wrap gap-4">
                <!-- Total Orders -->
                <div class="bg-white p-4 border border-gray-200 rounded shadow-sm flex-1 min-w-40">
                    <div class="text-gray-600 text-sm">Total Orders</div>
                    <div class="text-2xl font-bold text-gray-800">{{ $generalStats['total_orders'] }}</div>
                </div>

                <!-- Total Products -->
                <div class="bg-white p-4 border border-gray-200 rounded shadow-sm flex-1 min-w-40">
                    <div class="text-gray-600 text-sm">Total Products</div>
                    <div class="text-2xl font-bold text-gray-800">{{ $generalStats['total_products'] }}</div>
                </div>

                <!-- Total Users -->
                <div class="bg-white p-4 border border-gray-200 rounded shadow-sm flex-1 min-w-40">
                    <div class="text-gray-600 text-sm">Total Users</div>
                    <div class="text-2xl font-bold text-gray-800">{{ $generalStats['total_users'] }}</div>
                </div>

                <!-- Total Categories -->
                <div class="bg-white p-4 border border-gray-200 rounded shadow-sm flex-1 min-w-40">
                    <div class="text-gray-600 text-sm">Total Categories</div>
                    <div class="text-2xl font-bold text-gray-800">{{ $generalStats['total_categories'] }}</div>
                </div>
            </div>
        </div>

        <!-- Order Status Section -->
        <div class="mb-8">
            <h2 class="text-lg font-semibold text-gray-700 mb-4">Order Status</h2>
            
            <div class="flex flex-wrap gap-4">
                <div class="bg-white p-4 border border-gray-200 rounded shadow-sm">
                    <div class="text-green-600 text-sm">Completed</div>
                    <div class="text-xl font-bold">{{ $orderStats['completed'] }}</div>
                </div>

                <div class="bg-white p-4 border border-gray-200 rounded shadow-sm">
                    <div class="text-yellow-600 text-sm">Pending</div>
                    <div class="text-xl font-bold">{{ $orderStats['pending'] }}</div>
                </div>

                <div class="bg-white p-4 border border-gray-200 rounded shadow-sm">
                    <div class="text-blue-600 text-sm">Processing</div>
                    <div class="text-xl font-bold">{{ $orderStats['processing'] }}</div>
                </div>

                <div class="bg-white p-4 border border-gray-200 rounded shadow-sm">
                    <div class="text-red-600 text-sm">Cancelled</div>
                    <div class="text-xl font-bold">{{ $orderStats['cancelled'] }}</div>
                </div>
            </div>
        </div>

        <!-- Payment Status Section -->
        <div class="mb-8">
            <h2 class="text-lg font-semibold text-gray-700 mb-4">Payment Status</h2>
            
            <div class="flex flex-wrap gap-4">
                <div class="bg-white p-4 border border-gray-200 rounded shadow-sm">
                    <div class="text-green-600 text-sm">Completed</div>
                    <div class="text-xl font-bold">{{ $paymentStats['completed'] }}</div>
                </div>

                <div class="bg-white p-4 border border-gray-200 rounded shadow-sm">
                    <div class="text-yellow-600 text-sm">Pending</div>
                    <div class="text-xl font-bold">{{ $paymentStats['pending'] }}</div>
                </div>

                <div class="bg-white p-4 border border-gray-200 rounded shadow-sm">
                    <div class="text-red-600 text-sm">Failed</div>
                    <div class="text-xl font-bold">{{ $paymentStats['failed'] }}</div>
                </div>
            </div>
        </div>

        <!-- Recent Orders -->
        <div class="bg-white border border-gray-200 rounded shadow-sm mb-6">
            <div class="p-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-800">Recent Orders</h2>
            </div>
            
            @if($recentOrders->count() > 0)
                <div class="p-4">
                    @foreach($recentOrders as $order)
                    <div class="border-b border-gray-100 py-3 last:border-b-0">
                        <div class="flex justify-between items-center">
                            <div>
                                <div class="font-medium text-gray-800">
                                    Order #{{ $order->id }}
                                </div>
                                <div class="text-sm text-gray-600">
                                    {{ $order->user->name ?? 'N/A' }}
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="text-sm text-gray-600">{{ $order->status }}</div>
                                <div class="text-xs text-gray-500">{{ $order->created_at->format('M d, Y') }}</div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="p-8 text-center text-gray-500">
                    No recent orders found
                </div>
            @endif
        </div>

        <!-- Recent Payments -->
        <div class="bg-white border border-gray-200 rounded shadow-sm">
            <div class="p-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-800">Recent Payments</h2>
            </div>
            
            @if($recentPayments->count() > 0)
                <div class="p-4">
                    @foreach($recentPayments as $payment)
                    <div class="border-b border-gray-100 py-3 last:border-b-0">
                        <div class="flex justify-between items-center">
                            <div>
                                <div class="font-medium text-gray-800">
                                    Payment #{{ $payment->id }}
                                </div>
                                <div class="text-sm text-gray-600">
                                    {{ $payment->user->name ?? 'N/A' }} - {{ $payment->method ?? 'N/A' }}
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="text-sm text-gray-600">{{ $payment->status }}</div>
                                <div class="text-xs text-gray-500">{{ $payment->created_at->format('M d, Y') }}</div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="p-8 text-center text-gray-500">
                    No recent payments found
                </div>
            @endif
        </div>

    </div>
</x-layouts.admin>