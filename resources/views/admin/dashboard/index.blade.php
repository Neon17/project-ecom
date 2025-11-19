{{-- Clean Admin Dashboard --}}
<x-layouts.admin>
    <div class="py-6 px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-900">Dashboard Overview</h1>
            <p class="text-gray-600 mt-1">Welcome to your admin dashboard</p>
        </div>

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6 text-sm" role="alert">
                {{ session('error') }}
            </div>
        @endif

        <!-- General Stats -->
        <div class="mb-8">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Quick Stats</h2>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <!-- Total Orders -->
                <div class="bg-white p-4 border border-gray-200 rounded-lg">
                    <div class="flex items-center justify-between mb-2">
                        <div class="text-gray-600 text-sm">Total Orders</div>
                        <svg class="h-5 w-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 12H7.99" />
                        </svg>
                    </div>
                    <div class="text-2xl font-bold text-gray-900">{{ $generalStats['total_orders'] }}</div>
                </div>

                <!-- Total Products -->
                <div class="bg-white p-4 border border-gray-200 rounded-lg">
                    <div class="flex items-center justify-between mb-2">
                        <div class="text-gray-600 text-sm">Total Products</div>
                        <svg class="h-5 w-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                        </svg>
                    </div>
                    <div class="text-2xl font-bold text-gray-900">{{ $generalStats['total_products'] }}</div>
                </div>

                <!-- Total Users -->
                <div class="bg-white p-4 border border-gray-200 rounded-lg">
                    <div class="flex items-center justify-between mb-2">
                        <div class="text-gray-600 text-sm">Total Users</div>
                        <svg class="h-5 w-5 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h2a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2h2m3-2h6m-6 0h.01M9 13h6m-6 0a1 1 0 01-1-1v-1a1 1 0 011-1h6a1 1 0 011 1v1a1 1 0 01-1 1h-6z" />
                        </svg>
                    </div>
                    <div class="text-2xl font-bold text-gray-900">{{ $generalStats['total_users'] }}</div>
                </div>

                <!-- Total Categories -->
                <div class="bg-white p-4 border border-gray-200 rounded-lg">
                    <div class="flex items-center justify-between mb-2">
                        <div class="text-gray-600 text-sm">Total Categories</div>
                        <svg class="h-5 w-5 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v3a2 2 0 01-2 2h-5l-3 3v-3H5a2 2 0 01-2-2v-3a2 2 0 012-2h14z" />
                        </svg>
                    </div>
                    <div class="text-2xl font-bold text-gray-900">{{ $generalStats['total_categories'] }}</div>
                </div>
            </div>
        </div>

        <!-- Order Status -->
        <div class="mb-8">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Order Status</h2>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="bg-white p-4 border border-gray-200 rounded-lg">
                    <div class="flex items-center justify-between mb-2">
                        <div class="text-green-600 text-sm">Completed</div>
                        <svg class="h-5 w-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="text-2xl font-bold text-gray-900">{{ $orderStats['completed'] }}</div>
                </div>

                <div class="bg-white p-4 border border-gray-200 rounded-lg">
                    <div class="flex items-center justify-between mb-2">
                        <div class="text-yellow-600 text-sm">Pending</div>
                        <svg class="h-5 w-5 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9.971L11.604 13.347a.25.25 0 00.18.067h.459a.25.25 0 00.179-.067l3.376-3.376M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="text-2xl font-bold text-gray-900">{{ $orderStats['pending'] }}</div>
                </div>

                <div class="bg-white p-4 border border-gray-200 rounded-lg">
                    <div class="flex items-center justify-between mb-2">
                        <div class="text-blue-600 text-sm">Processing</div>
                        <svg class="h-5 w-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.836 0a9.971 9.971 0 00-1.874-2M12 18H5.503c-.617 0-1.127-.504-1.096-1.117L4.17 14.244m7.561 4.756a9.971 9.971 0 001.874-2M12 18v2m-3 0h6" />
                        </svg>
                    </div>
                    <div class="text-2xl font-bold text-gray-900">{{ $orderStats['processing'] }}</div>
                </div>

                <div class="bg-white p-4 border border-gray-200 rounded-lg">
                    <div class="flex items-center justify-between mb-2">
                        <div class="text-red-600 text-sm">Cancelled</div>
                        <svg class="h-5 w-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="text-2xl font-bold text-gray-900">{{ $orderStats['cancelled'] }}</div>
                </div>
            </div>
        </div>

        <!-- Payment Status -->
        <div class="mb-8">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Payment Status</h2>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                <div class="bg-white p-4 border border-gray-200 rounded-lg">
                    <div class="flex items-center justify-between mb-2">
                        <div class="text-green-600 text-sm">Completed</div>
                        <svg class="h-5 w-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="text-2xl font-bold text-gray-900">{{ $paymentStats['completed'] }}</div>
                </div>

                <div class="bg-white p-4 border border-gray-200 rounded-lg">
                    <div class="flex items-center justify-between mb-2">
                        <div class="text-yellow-600 text-sm">Pending</div>
                        <svg class="h-5 w-5 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9.971L11.604 13.347a.25.25 0 00.18.067h.459a.25.25 0 00.179-.067l3.376-3.376M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="text-2xl font-bold text-gray-900">{{ $paymentStats['pending'] }}</div>
                </div>

                <div class="bg-white p-4 border border-gray-200 rounded-lg">
                    <div class="flex items-center justify-between mb-2">
                        <div class="text-red-600 text-sm">Failed</div>
                        <svg class="h-5 w-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="text-2xl font-bold text-gray-900">{{ $paymentStats['failed'] }}</div>
                </div>
            </div>
        </div>

        <!-- Recent Orders -->
        <div class="bg-white border border-gray-200 rounded-lg mb-6">
            <div class="p-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-800">Recent Orders</h2>
            </div>
            
            @if($recentOrders->count() > 0)
                <div class="p-4">
                    @foreach($recentOrders as $order)
                    <div class="border-b border-gray-100 py-3 last:border-b-0">
                        <div class="flex items-center justify-between">
                            <div>
                                <div class="font-medium text-gray-800">
                                    Order #{{ $order->id }}
                                </div>
                                <div class="text-sm text-gray-600 mt-1">
                                    {{ $order->user->name ?? 'N/A' }}
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="text-sm text-gray-600">Status: <span class="font-medium text-blue-600">{{ $order->status }}</span></div>
                                <div class="text-xs text-gray-500 mt-1">{{ $order->created_at->format('M d, Y H:i') }}</div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="p-6 text-center text-gray-500 text-sm">
                    No recent orders found
                </div>
            @endif
        </div>

        <!-- Recent Payments -->
        <div class="bg-white border border-gray-200 rounded-lg">
            <div class="p-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-800">Recent Payments</h2>
            </div>
            
            @if($recentPayments->count() > 0)
                <div class="p-4">
                    @foreach($recentPayments as $payment)
                    <div class="border-b border-gray-100 py-3 last:border-b-0">
                        <div class="flex items-center justify-between">
                            <div>
                                <div class="font-medium text-gray-800">
                                    Payment #{{ $payment->id }}
                                </div>
                                <div class="text-sm text-gray-600 mt-1">
                                    {{ $payment->user->name ?? 'N/A' }} - <span class="text-purple-600">{{ $payment->method ?? 'N/A' }}</span>
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="text-sm text-gray-600">Status: <span class="font-medium text-green-600">{{ $payment->status }}</span></div>
                                <div class="text-xs text-gray-500 mt-1">{{ $payment->created_at->format('M d, Y H:i') }}</div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="p-6 text-center text-gray-500 text-sm">
                    No recent payments found
                </div>
            @endif
        </div>
    </div>
</x-layouts.admin>