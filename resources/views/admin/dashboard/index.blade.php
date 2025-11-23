<x-layouts.admin>
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50/20 p-6">

        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">Dashboard Overview</h1>
                    <p class="text-gray-600 text-lg">Welcome back! Here's what's happening with your store today.</p>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="bg-white rounded-2xl px-4 py-2 shadow-sm border border-gray-100">
                        <div class="text-sm text-gray-500">Today</div>
                        <div class="text-lg font-semibold text-gray-900">{{ now()->format('M d, Y') }}</div>
                    </div>
                </div>
            </div>
        </div>

        @if(session('error'))
            <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-xl shadow-sm">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-red-700">{{ session('error') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <!-- Main Stats Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">
            <!-- Total Orders -->
            <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-blue-50 rounded-xl">
                        <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                    <div class="text-right">
                        <div class="text-sm font-medium text-green-600">+12%</div>
                        <div class="text-xs text-gray-500">from last month</div>
                    </div>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-1">{{ $generalStats['total_orders'] }}</h3>
                <p class="text-gray-600 text-sm">Total Orders</p>
            </div>

            <!-- Total Products -->
            <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-green-50 rounded-xl">
                        <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                        </svg>
                    </div>
                    <div class="text-right">
                        <div class="text-sm font-medium text-green-600">+8%</div>
                        <div class="text-xs text-gray-500">from last month</div>
                    </div>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-1">{{ $generalStats['total_products'] }}</h3>
                <p class="text-gray-600 text-sm">Total Products</p>
            </div>

            <!-- Total Users -->
            <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-purple-50 rounded-xl">
                        <svg class="h-6 w-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h2a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2h2m3-2h6m-6 0h.01M9 13h6m-6 0a1 1 0 01-1-1v-1a1 1 0 011-1h6a1 1 0 011 1v1a1 1 0 01-1 1h-6z"/>
                        </svg>
                    </div>
                    <div class="text-right">
                        <div class="text-sm font-medium text-green-600">+15%</div>
                        <div class="text-xs text-gray-500">from last month</div>
                    </div>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-1">{{ $generalStats['total_users'] }}</h3>
                <p class="text-gray-600 text-sm">Total Users</p>
            </div>

            <!-- Total Categories -->
            <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-amber-50 rounded-xl">
                        <svg class="h-6 w-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v3a2 2 0 01-2 2h-5l-3 3v-3H5a2 2 0 01-2-2v-3a2 2 0 012-2h14z"/>
                        </svg>
                    </div>
                    <div class="text-right">
                        <div class="text-sm font-medium text-green-600">+5%</div>
                        <div class="text-xs text-gray-500">from last month</div>
                    </div>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-1">{{ $generalStats['total_categories'] }}</h3>
                <p class="text-gray-600 text-sm">Total Categories</p>
            </div>
        </div>

        <!-- Analytics Section -->
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6 mb-8">
            <!-- Order Status -->
            <div class="xl:col-span-2 bg-white rounded-2xl p-6 shadow-lg border border-gray-100">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-bold text-gray-900">Order Analytics</h2>
                    <div class="flex space-x-2">
                        <button class="px-3 py-1 text-sm bg-blue-50 text-blue-600 rounded-lg font-medium">Week</button>
                        <button class="px-3 py-1 text-sm text-gray-500 hover:text-gray-700 rounded-lg font-medium">Month</button>
                        <button class="px-3 py-1 text-sm text-gray-500 hover:text-gray-700 rounded-lg font-medium">Year</button>
                    </div>
                </div>
                
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div class="text-center p-4 bg-green-50 rounded-xl border border-green-100">
                        <div class="text-2xl font-bold text-green-600 mb-1">{{ $orderStats['completed'] }}</div>
                        <div class="text-sm font-medium text-green-700">Completed</div>
                    </div>
                    <div class="text-center p-4 bg-yellow-50 rounded-xl border border-yellow-100">
                        <div class="text-2xl font-bold text-yellow-600 mb-1">{{ $orderStats['pending'] }}</div>
                        <div class="text-sm font-medium text-yellow-700">Pending</div>
                    </div>
                    <div class="text-center p-4 bg-blue-50 rounded-xl border border-blue-100">
                        <div class="text-2xl font-bold text-blue-600 mb-1">{{ $orderStats['processing'] }}</div>
                        <div class="text-sm font-medium text-blue-700">Processing</div>
                    </div>
                    <div class="text-center p-4 bg-red-50 rounded-xl border border-red-100">
                        <div class="text-2xl font-bold text-red-600 mb-1">{{ $orderStats['cancelled'] }}</div>
                        <div class="text-sm font-medium text-red-700">Cancelled</div>
                    </div>
                </div>
            </div>

            <!-- Payment Status -->
            <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100">
                <h2 class="text-xl font-bold text-gray-900 mb-6">Payment Status</h2>
                
                <div class="space-y-4">
                    <div class="flex items-center justify-between p-4 bg-green-50 rounded-xl border border-green-100">
                        <div class="flex items-center">
                            <div class="w-3 h-3 bg-green-500 rounded-full mr-3"></div>
                            <span class="font-medium text-green-700">Completed</span>
                        </div>
                        <span class="text-xl font-bold text-green-600">{{ $paymentStats['completed'] }}</span>
                    </div>
                    
                    <div class="flex items-center justify-between p-4 bg-yellow-50 rounded-xl border border-yellow-100">
                        <div class="flex items-center">
                            <div class="w-3 h-3 bg-yellow-500 rounded-full mr-3"></div>
                            <span class="font-medium text-yellow-700">Pending</span>
                        </div>
                        <span class="text-xl font-bold text-yellow-600">{{ $paymentStats['pending'] }}</span>
                    </div>
                    
                    <div class="flex items-center justify-between p-4 bg-red-50 rounded-xl border border-red-100">
                        <div class="flex items-center">
                            <div class="w-3 h-3 bg-red-500 rounded-full mr-3"></div>
                            <span class="font-medium text-red-700">Failed</span>
                        </div>
                        <span class="text-xl font-bold text-red-600">{{ $paymentStats['failed'] }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Recent Orders -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-100">
                    <div class="flex items-center justify-between">
                        <h2 class="text-xl font-bold text-gray-900">Recent Orders</h2>
                        <a href="#" class="text-blue-600 hover:text-blue-700 text-sm font-medium">View All</a>
                    </div>
                </div>
                
                <div class="divide-y divide-gray-100">
                    @if($recentOrders->count() > 0)
                        @foreach($recentOrders as $order)
                        <div class="p-4 hover:bg-gray-50 transition-colors duration-200">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-4">
                                    <div class="w-10 h-10 bg-blue-50 rounded-lg flex items-center justify-center">
                                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="font-semibold text-gray-900">Order #{{ $order->id }}</div>
                                        <div class="text-sm text-gray-500">{{ $order->user->name ?? 'Guest User' }}</div>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <div class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
                                        {{ $order->status === 'completed' ? 'bg-green-100 text-green-800' : '' }}
                                        {{ $order->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                        {{ $order->status === 'processing' ? 'bg-blue-100 text-blue-800' : '' }}
                                        {{ $order->status === 'cancelled' ? 'bg-red-100 text-red-800' : '' }}">
                                        {{ ucfirst($order->status) }}
                                    </div>
                                    <div class="text-xs text-gray-500 mt-1">{{ $order->created_at->format('M d, Y') }}</div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div class="p-8 text-center">
                            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                </svg>
                            </div>
                            <p class="text-gray-500 text-lg font-medium">No recent orders</p>
                            <p class="text-gray-400 text-sm mt-1">New orders will appear here</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Recent Payments -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-100">
                    <div class="flex items-center justify-between">
                        <h2 class="text-xl font-bold text-gray-900">Recent Payments</h2>
                        <a href="#" class="text-blue-600 hover:text-blue-700 text-sm font-medium">View All</a>
                    </div>
                </div>
                
                <div class="divide-y divide-gray-100">
                    @if($recentPayments->count() > 0)
                        @foreach($recentPayments as $payment)
                        <div class="p-4 hover:bg-gray-50 transition-colors duration-200">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-4">
                                    <div class="w-10 h-10 bg-green-50 rounded-lg flex items-center justify-center">
                                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="font-semibold text-gray-900">Payment #{{ $payment->id }}</div>
                                        <div class="text-sm text-gray-500">{{ $payment->user->name ?? 'Guest User' }}</div>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <div class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
                                        {{ $payment->status->value === 'completed' ? 'bg-green-100 text-green-800' : '' }}
                                        {{ $payment->status->value === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                        {{ $payment->status->value === 'failed' ? 'bg-red-100 text-red-800' : '' }}">
                                        {{ ucfirst($payment->status->value) }}
                                    </div>
                                    <div class="text-xs text-gray-500 mt-1">{{ $payment->created_at->format('M d, Y') }}</div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div class="p-8 text-center">
                            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <p class="text-gray-500 text-lg font-medium">No recent payments</p>
                            <p class="text-gray-400 text-sm mt-1">Payment activities will appear here</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <style>
        .hover-lift:hover {
            transform: translateY(-2px);
            transition: transform 0.2s ease-in-out;
        }
    </style>
</x-layouts.admin>