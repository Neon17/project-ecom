<x-layouts.user>
    <div class="mb-6 md:mb-8">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Dashboard</h1>
        <p class="text-gray-600 dark:text-gray-300">Welcome back, {{ auth()->user()->name }}!</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6 mb-6 md:mb-8">
        <div class="bg-white dark:bg-slate-900 p-6 rounded-lg shadow-sm border border-gray-100 dark:border-gray-700">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-600 dark:text-blue-400 mr-4">
                    <i class="fas fa-shopping-bag text-xl"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Total Orders</p>
                    <p class="text-2xl font-bold text-gray-800 dark:text-white">{{ auth()->user()->orders()->count() }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white dark:bg-slate-900 p-6 rounded-lg shadow-sm border border-gray-100 dark:border-gray-700">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-600 mr-4">
                    <i class="fas fa-check-circle text-xl"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Completed Orders</p>
                    <p class="text-2xl font-bold text-gray-800 dark:text-white">{{ auth()->user()->orders()->where('status', 'completed')->count() }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-slate-900 p-6 rounded-lg shadow-sm border border-gray-100 dark:border-gray-700">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-purple-100 text-purple-600 mr-4">
                    <i class="fas fa-map-marker-alt text-xl"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Saved Addresses</p>
                    <p class="text-2xl font-bold text-gray-800 dark:text-white">{{ auth()->user()->addresses()->count() }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white dark:bg-slate-900 rounded-lg shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
        <div class="px-4 md:px-6 py-4 border-b border-gray-100 dark:border-gray-700 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-2 bg-gray-50 dark:bg-slate-800">
            <h2 class="text-lg font-bold text-gray-800 dark:text-white">Recent Orders</h2>
            <a href="{{ route('user.orders.index') }}" class="text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 text-sm font-medium flex items-center gap-1">
                View All
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </a>
        </div>

        {{-- Desktop Table View --}}
        <div class="hidden md:block overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-white dark:bg-slate-900 text-gray-500 dark:text-gray-300 text-xs uppercase tracking-wider border-b border-gray-100 dark:border-gray-700">
                        <th class="px-6 py-3 font-medium">Order ID</th>
                        <th class="px-6 py-3 font-medium">Date</th>
                        <th class="px-6 py-3 font-medium">Status</th>
                        <th class="px-6 py-3 font-medium">Total</th>
                        <th class="px-6 py-3 font-medium">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 dark:divide-gray-700">
                    @forelse(auth()->user()->orders()->latest()->take(5)->get() as $order)
                        <tr class="hover:bg-gray-50 dark:hover:bg-slate-800 transition-colors group">
                            <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">#{{ $order->id }}</td>
                            <td class="px-6 py-4 text-gray-500 dark:text-gray-400 text-sm">{{ $order->created_at->format('M d, Y') }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2.5 py-0.5 rounded-full text-xs font-medium border
                                    {{ $order->status === 'completed' ? 'bg-green-50 text-green-700 border-green-100' : 
                                       ($order->status === 'pending' ? 'bg-yellow-50 text-yellow-700 border-yellow-100' : 
                                       ($order->status === 'cancelled' ? 'bg-red-50 text-red-700 border-red-100' : 'bg-blue-50 text-blue-700 border-blue-100')) }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900 dark:text-white text-sm">NPR {{ number_format($order->total_amount / 100, 2) }}</td>
                            <td class="px-6 py-4">
                                <a href="{{ route('user.orders.show', $order) }}" class="text-gray-400 dark:text-gray-500 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-gray-500 dark:text-gray-400">
                                <div class="flex flex-col items-center justify-center">
                                    <svg class="w-12 h-12 text-gray-300 dark:text-gray-600 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                                    <p class="text-base font-medium text-gray-900 dark:text-white">No orders yet</p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">Start shopping to see your orders here.</p>
                                    <a href="{{ route('products.index') }}" class="text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 font-medium text-sm">Browse Products &rarr;</a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Mobile Card View --}}
        <div class="md:hidden divide-y divide-gray-100 dark:border-gray-700">
            @forelse(auth()->user()->orders()->latest()->take(5)->get() as $order)
                <div class="p-4 hover:bg-gray-50 dark:hover:bg-slate-800 transition-colors">
                    <div class="flex justify-between items-start mb-3">
                        <div>
                            <div class="text-sm font-semibold text-gray-900 dark:text-white">Order #{{ $order->id }}</div>
                            <div class="text-xs text-gray-500 dark:text-gray-400">{{ $order->created_at->format('M d, Y') }}</div>
                        </div>
                        <span class="px-2 py-1 text-xs font-medium rounded-full border
                            {{ $order->status === 'completed' ? 'bg-green-50 text-green-700 border-green-100' : 
                               ($order->status === 'pending' ? 'bg-yellow-50 text-yellow-700 border-yellow-100' : 
                               ($order->status === 'cancelled' ? 'bg-red-50 text-red-700 border-red-100' : 'bg-blue-50 text-blue-700 border-blue-100')) }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="font-semibold text-gray-900 dark:text-white">NPR {{ number_format($order->total_amount / 100, 2) }}</span>
                        <a href="{{ route('user.orders.show', $order) }}" class="px-4 py-2 text-sm font-medium text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 flex items-center gap-1">
                            View
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </a>
                    </div>
                </div>
            @empty
                <div class="p-8 text-center">
                    <svg class="w-12 h-12 text-gray-300 dark:text-gray-600 mb-3 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                    <p class="text-base font-medium text-gray-900 dark:text-white mb-1">No orders yet</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">Start shopping to see your orders here.</p>
                    <a href="{{ route('products.index') }}" class="text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 font-medium text-sm">Browse Products &rarr;</a>
                </div>
            @endforelse
        </div>
    </div>
</x-layouts.user>
