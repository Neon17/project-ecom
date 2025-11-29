<x-layouts.admin>
    <div class="min-h-screen">

        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Dashboard Overview</h1>
                    <p class="text-gray-600 dark:text-gray-300 dark:text-gray-600 text-lg">Welcome back! Here's what's happening with your store today.</p>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="bg-white dark:bg-slate-900 rounded-2xl px-4 py-2 shadow-sm border border-gray-100 dark:border-gray-700">
                        <div class="text-sm text-gray-500 dark:text-gray-400 dark:text-gray-500">Today</div>
                        <div class="text-lg font-semibold text-gray-900 dark:text-white">{{ now()->format('M d, Y') }}</div>
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
            <div class="bg-white dark:bg-slate-900 rounded-2xl p-6 shadow-lg border border-gray-100 dark:border-gray-700 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-blue-50 rounded-xl">
                        <svg class="h-6 w-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                    <div class="text-right">
                        <div class="text-sm font-medium text-green-600">+12%</div>
                        <div class="text-xs text-gray-500 dark:text-gray-400 dark:text-gray-500">from last month</div>
                    </div>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-1">{{ $generalStats['total_orders'] }}</h3>
                <p class="text-gray-600 dark:text-gray-300 dark:text-gray-600 text-sm">Total Orders</p>
            </div>

            <!-- Total Products -->
            <div class="bg-white dark:bg-slate-900 rounded-2xl p-6 shadow-lg border border-gray-100 dark:border-gray-700 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-green-50 rounded-xl">
                        <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                        </svg>
                    </div>
                    <div class="text-right">
                        <div class="text-sm font-medium text-green-600">+8%</div>
                        <div class="text-xs text-gray-500 dark:text-gray-400 dark:text-gray-500">from last month</div>
                    </div>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-1">{{ $generalStats['total_products'] }}</h3>
                <p class="text-gray-600 dark:text-gray-300 dark:text-gray-600 text-sm">Total Products</p>
            </div>

            <!-- Total Users -->
            <div class="bg-white dark:bg-slate-900 rounded-2xl p-6 shadow-lg border border-gray-100 dark:border-gray-700 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-purple-50 rounded-xl">
                        <svg class="h-6 w-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h2a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2h2m3-2h6m-6 0h.01M9 13h6m-6 0a1 1 0 01-1-1v-1a1 1 0 011-1h6a1 1 0 011 1v1a1 1 0 01-1 1h-6z"/>
                        </svg>
                    </div>
                    <div class="text-right">
                        <div class="text-sm font-medium text-green-600">+15%</div>
                        <div class="text-xs text-gray-500 dark:text-gray-400 dark:text-gray-500">from last month</div>
                    </div>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-1">{{ $generalStats['total_users'] }}</h3>
                <p class="text-gray-600 dark:text-gray-300 dark:text-gray-600 text-sm">Total Users</p>
            </div>

            <!-- Total Categories -->
            <div class="bg-white dark:bg-slate-900 rounded-2xl p-6 shadow-lg border border-gray-100 dark:border-gray-700 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-amber-50 rounded-xl">
                        <svg class="h-6 w-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v3a2 2 0 01-2 2h-5l-3 3v-3H5a2 2 0 01-2-2v-3a2 2 0 012-2h14z"/>
                        </svg>
                    </div>
                    <div class="text-right">
                        <div class="text-sm font-medium text-green-600">+5%</div>
                        <div class="text-xs text-gray-500 dark:text-gray-400 dark:text-gray-500">from last month</div>
                    </div>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-1">{{ $generalStats['total_categories'] }}</h3>
                <p class="text-gray-600 dark:text-gray-300 dark:text-gray-600 text-sm">Total Categories</p>
            </div>
        </div>

        <!-- Revenue Analytics Section -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
            <!-- Revenue Card -->
            <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl p-6 shadow-lg text-white">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-white/20 rounded-xl">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="text-right">
                        <div class="text-sm font-medium {{ $revenueData['growth'] >= 0 ? 'text-green-200' : 'text-red-200' }}">
                            {{ $revenueData['growth'] >= 0 ? '+' : '' }}{{ $revenueData['growth'] }}%
                        </div>
                        <div class="text-xs opacity-80">this month</div>
                    </div>
                </div>
                <h3 class="text-3xl font-bold mb-1">NPR {{ number_format($revenueData['total'], 2) }}</h3>
                <p class="text-blue-100 text-sm">Total Revenue</p>
            </div>

            <!-- Revenue Trend Chart -->
            <div class="lg:col-span-2 bg-white dark:bg-slate-900 rounded-2xl p-6 shadow-lg border border-gray-100 dark:border-gray-700">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Revenue Trend (Last 30 Days)</h2>
                <div class="h-64">
                    <canvas id="revenueChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Sales & Products Analytics -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <!-- Sales Trends -->
            <div class="bg-white dark:bg-slate-900 rounded-2xl p-6 shadow-lg border border-gray-100 dark:border-gray-700">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Sales Trends (Last 7 Days)</h2>
                <div class="h-64">
                    <canvas id="salesChart"></canvas>
                </div>
            </div>

            <!-- Top Products -->
            <div class="bg-white dark:bg-slate-900 rounded-2xl p-6 shadow-lg border border-gray-100 dark:border-gray-700">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Top Selling Products</h2>
                <div class="space-y-4">
                    @forelse($topProducts as $product)
                        <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-slate-800 rounded-lg">
                            <div class="flex items-center space-x-3 flex-1 min-w-0">
                                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" 
                                     class="w-12 h-12 rounded-lg object-cover">
                                <div class="flex-1 min-w-0">
                                    <div class="text-sm font-medium text-gray-900 dark:text-white truncate">{{ $product->name }}</div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400">NPR {{ number_format($product->price, 2) }}</div>
                                </div>
                            </div>
                            <div class="ml-4 flex-shrink-0">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    {{ $product->total_sold ?? 0 }} sold
                                </span>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8 text-gray-500 dark:text-gray-400">
                            <p class="text-sm">No sales data available yet</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Analytics Section -->
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6 mb-8">
            <!-- Order Status -->
            <div class="xl:col-span-2 bg-white dark:bg-slate-900 rounded-2xl p-6 shadow-lg border border-gray-100 dark:border-gray-700">
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between mb-6 gap-4">
                    <h2 class="text-xl font-bold text-gray-900 dark:text-white">Order Analytics</h2>
                    <div class="flex flex-wrap gap-2">
                        <button class="px-3 py-1 text-sm bg-blue-50 text-blue-600 dark:text-blue-400 rounded-lg font-medium">Week</button>
                        <button class="px-3 py-1 text-sm text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 rounded-lg font-medium">Month</button>
                        <button class="px-3 py-1 text-sm text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 rounded-lg font-medium">Year</button>
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
                        <div class="text-2xl font-bold text-blue-600 dark:text-blue-400 mb-1">{{ $orderStats['processing'] }}</div>
                        <div class="text-sm font-medium text-blue-700">Processing</div>
                    </div>
                    <div class="text-center p-4 bg-red-50 rounded-xl border border-red-100">
                        <div class="text-2xl font-bold text-red-600 mb-1">{{ $orderStats['cancelled'] }}</div>
                        <div class="text-sm font-medium text-red-700">Cancelled</div>
                    </div>
                </div>
            </div>

            <!-- Payment Status -->
            <div class="bg-white dark:bg-slate-900 rounded-2xl p-6 shadow-lg border border-gray-100 dark:border-gray-700">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-6">Payment Status</h2>
                
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
            <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-700 flex justify-between items-center bg-gray-50 dark:bg-slate-800">
                    <h2 class="text-lg font-bold text-gray-800 dark:text-gray-200">Recent Orders</h2>
                    <a href="{{ route('admin.orders.index') }}" class="text-blue-600 dark:text-blue-400 hover:text-blue-700 text-sm font-medium flex items-center gap-1">
                        View All
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </a>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <tbody class="divide-y divide-gray-50">
                            @forelse($recentOrders as $order)
                            <tr class="hover:bg-gray-50 dark:hover:bg-slate-700 dark:bg-slate-800 transition-colors duration-200">
                                <td class="px-6 py-4">
                                    <div class="flex items-center space-x-4">
                                        <div class="w-10 h-10 bg-blue-50 rounded-lg flex items-center justify-center text-blue-600 dark:text-blue-400">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="font-semibold text-gray-900 dark:text-white text-sm">Order #{{ $order->id }}</div>
                                            <div class="text-xs text-gray-500 dark:text-gray-400 dark:text-gray-500">{{ $order->user->name ?? 'Guest User' }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <span class="px-2.5 py-0.5 rounded-full text-xs font-medium border
                                        {{ $order->status === 'completed' ? 'bg-green-50 text-green-700 border-green-100' : 
                                           ($order->status === 'pending' ? 'bg-yellow-50 text-yellow-700 border-yellow-100' : 
                                           ($order->status === 'processing' ? 'bg-blue-50 text-blue-700 border-blue-100' : 'bg-red-50 text-red-700 border-red-100')) }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                    <div class="text-xs text-gray-400 dark:text-gray-500 mt-1">{{ $order->created_at->format('M d, Y') }}</div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="2" class="px-6 py-8 text-center text-gray-500 dark:text-gray-400 dark:text-gray-500">
                                    No recent orders
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Recent Payments -->
            <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-700 flex justify-between items-center bg-gray-50 dark:bg-slate-800">
                    <h2 class="text-lg font-bold text-gray-800 dark:text-gray-200">Recent Payments</h2>
                    <a href="{{ route('admin.payments.index') }}" class="text-blue-600 dark:text-blue-400 hover:text-blue-700 text-sm font-medium flex items-center gap-1">
                        View All
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </a>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <tbody class="divide-y divide-gray-50">
                            @forelse($recentPayments as $payment)
                            <tr class="hover:bg-gray-50 dark:hover:bg-slate-700 dark:bg-slate-800 transition-colors duration-200">
                                <td class="px-6 py-4">
                                    <div class="flex items-center space-x-4">
                                        <div class="w-10 h-10 bg-green-50 rounded-lg flex items-center justify-center text-green-600">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="font-semibold text-gray-900 dark:text-white text-sm">Payment #{{ $payment->id }}</div>
                                            <div class="text-xs text-gray-500 dark:text-gray-400 dark:text-gray-500">{{ $payment->order->user->name ?? 'Guest User' }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <span class="px-2.5 py-0.5 rounded-full text-xs font-medium border
                                        {{ $payment->status->value === 'completed' ? 'bg-green-50 text-green-700 border-green-100' : 
                                           ($payment->status->value === 'pending' ? 'bg-yellow-50 text-yellow-700 border-yellow-100' : 'bg-red-50 text-red-700 border-red-100') }}">
                                        {{ ucfirst($payment->status->value) }}
                                    </span>
                                    <div class="text-xs text-gray-400 dark:text-gray-500 mt-1">{{ $payment->created_at->format('M d, Y') }}</div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="2" class="px-6 py-8 text-center text-gray-500 dark:text-gray-400 dark:text-gray-500">
                                    No recent payments
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script>
        // Check if dark mode is enabled
        const isDarkMode = document.documentElement.classList.contains('dark');
        
        // Chart colors
        const colors = {
            primary: isDarkMode ? 'rgb(96, 165, 250)' : 'rgb(59, 130, 246)',
            primaryLight: isDarkMode ? 'rgba(96, 165, 250, 0.1)' : 'rgba(59, 130, 246, 0.1)',
            grid: isDarkMode ? 'rgba(255, 255, 255, 0.1)' : 'rgba(0, 0, 0, 0.1)',
            text: isDarkMode ? 'rgba(255, 255, 255, 0.7)' : 'rgba(0, 0, 0, 0.7)',
        };

        // Revenue Chart
        const revenueCtx = document.getElementById('revenueChart').getContext('2d');
        const revenueChart = new Chart(revenueCtx, {
            type: 'line',
            data: {
                labels: {!! json_encode($revenueData['labels']) !!},
                datasets: [{
                    label: 'Revenue (NPR)',
                    data: {!! json_encode($revenueData['data']) !!},
                    borderColor: colors.primary,
                    backgroundColor: colors.primaryLight,
                    borderWidth: 2,
                    fill: true,
                    tension: 0.4,
                    pointRadius: 3,
                    pointHoverRadius: 5,
                    pointBackgroundColor: colors.primary,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: colors.grid
                        },
                        ticks: {
                            color: colors.text,
                            callback: function(value) {
                                return 'NPR ' + value.toLocaleString();
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: colors.text
                        }
                    }
                }
            }
        });

        // Sales Trends Chart
        const salesCtx = document.getElementById('salesChart').getContext('2d');
        const salesChart = new Chart(salesCtx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($salesTrends['labels']) !!},
                datasets: [{
                    label: 'Orders',
                    data: {!! json_encode($salesTrends['data']) !!},
                    backgroundColor: colors.primary,
                    borderColor: colors.primary,
                    borderWidth: 1,
                    borderRadius: 8,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: colors.grid
                        },
                        ticks: {
                            color: colors.text,
                            stepSize: 1
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: colors.text
                        }
                    }
                }
            }
        });

        // Update charts when theme changes
        document.addEventListener('themeChanged', function() {
            window.location.reload(); // Reload to get new theme colors
        });
    </script>
</x-layouts.admin>