<x-layouts.user>
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-800">Dashboard</h1>
        <p class="text-gray-600">Welcome back, {{ auth()->user()->name }}!</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-600 mr-4">
                    <i class="fas fa-shopping-bag text-xl"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Total Orders</p>
                    <p class="text-2xl font-bold text-gray-800">{{ auth()->user()->orders()->count() }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-600 mr-4">
                    <i class="fas fa-check-circle text-xl"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Completed Orders</p>
                    <p class="text-2xl font-bold text-gray-800">{{ auth()->user()->orders()->where('status', 'completed')->count() }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-purple-100 text-purple-600 mr-4">
                    <i class="fas fa-map-marker-alt text-xl"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Saved Addresses</p>
                    <p class="text-2xl font-bold text-gray-800">{{ auth()->user()->addresses()->count() }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50">
            <h2 class="text-lg font-bold text-gray-800">Recent Orders</h2>
            <a href="{{ route('user.orders.index') }}" class="text-blue-600 hover:text-blue-700 text-sm font-medium flex items-center gap-1">
                View All
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-white text-gray-500 text-xs uppercase tracking-wider border-b border-gray-100">
                        <th class="px-6 py-3 font-medium">Order ID</th>
                        <th class="px-6 py-3 font-medium">Date</th>
                        <th class="px-6 py-3 font-medium">Status</th>
                        <th class="px-6 py-3 font-medium">Total</th>
                        <th class="px-6 py-3 font-medium">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse(auth()->user()->orders()->latest()->take(5)->get() as $order)
                        <tr class="hover:bg-gray-50 transition-colors group">
                            <td class="px-6 py-4 font-medium text-gray-900">#{{ $order->id }}</td>
                            <td class="px-6 py-4 text-gray-500 text-sm">{{ $order->created_at->format('M d, Y') }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2.5 py-0.5 rounded-full text-xs font-medium border
                                    {{ $order->status === 'completed' ? 'bg-green-50 text-green-700 border-green-100' : 
                                       ($order->status === 'pending' ? 'bg-yellow-50 text-yellow-700 border-yellow-100' : 
                                       ($order->status === 'cancelled' ? 'bg-red-50 text-red-700 border-red-100' : 'bg-blue-50 text-blue-700 border-blue-100')) }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900 text-sm">NPR {{ number_format($order->total_amount / 100, 2) }}</td>
                            <td class="px-6 py-4">
                                <a href="{{ route('user.orders.show', $order) }}" class="text-gray-400 hover:text-blue-600 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                <div class="flex flex-col items-center justify-center">
                                    <svg class="w-12 h-12 text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                                    <p class="text-base font-medium text-gray-900">No orders yet</p>
                                    <p class="text-sm text-gray-500 mb-4">Start shopping to see your orders here.</p>
                                    <a href="{{ route('products.index') }}" class="text-blue-600 hover:text-blue-700 font-medium text-sm">Browse Products &rarr;</a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-layouts.user>
