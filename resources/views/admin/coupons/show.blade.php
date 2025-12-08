<x-layouts.admin>
    <div class="max-w-7xl mx-auto">
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Coupon Details</h1>
                    <p class="text-gray-600 dark:text-gray-300 mt-2">View coupon usage and statistics</p>
                </div>
                <a href="{{ route('admin.coupons.index') }}"
                    class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-slate-900 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-slate-700 transition-colors">
                    ← Back to Coupons
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
            <!-- Coupon Info Card -->
            <div class="bg-white dark:bg-slate-900 rounded-lg shadow-sm border border-gray-200 dark:border-slate-700 p-6">
                <h2 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Coupon Information</h2>
                <div class="space-y-4">
                    <div>
                        <label class="text-xs text-gray-500 dark:text-gray-400 uppercase font-semibold">Code</label>
                        <p class="text-xl font-mono font-bold text-blue-600 dark:text-blue-400">{{ $coupon->code }}</p>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="text-xs text-gray-500 dark:text-gray-400 uppercase font-semibold">Type</label>
                            <p class="text-gray-900 dark:text-white font-medium">{{ ucfirst($coupon->type) }}</p>
                        </div>
                        <div>
                            <label class="text-xs text-gray-500 dark:text-gray-400 uppercase font-semibold">Value</label>
                            <p class="text-gray-900 dark:text-white font-medium">
                                {{ $coupon->type === 'percentage' ? $coupon->value . '%' : 'NPR ' . number_format($coupon->value, 2) }}
                            </p>
                        </div>
                    </div>
                    <div>
                        <label class="text-xs text-gray-500 dark:text-gray-400 uppercase font-semibold">Status</label>
                        <div class="mt-1">
                            @if($coupon->isValid())
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                            @else
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Inactive</span>
                            @endif
                        </div>
                    </div>
                    <div>
                        <label class="text-xs text-gray-500 dark:text-gray-400 uppercase font-semibold">Expires</label>
                        <p class="text-gray-900 dark:text-white font-medium">
                            {{ $coupon->expires_at ? $coupon->expires_at->format('M d, Y h:i A') : 'Never' }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Usage Stats Card -->
            <div class="bg-white dark:bg-slate-900 rounded-lg shadow-sm border border-gray-200 dark:border-slate-700 p-6">
                <h2 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Usage Statistics</h2>
                <div class="space-y-6">
                    <div>
                        <label class="text-xs text-gray-500 dark:text-gray-400 uppercase font-semibold">Total Orders</label>
                        <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ $coupon->used_count }}</p>
                        @if($coupon->max_uses)
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                out of {{ $coupon->max_uses }} allowed uses
                                <span class="text-xs ml-1">({{ round(($coupon->used_count / $coupon->max_uses) * 100) }}%)</span>
                            </p>
                            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2 mt-2">
                                <div class="bg-blue-600 h-2 rounded-full" style="width: {{ min(100, ($coupon->used_count / $coupon->max_uses) * 100) }}%"></div>
                            </div>
                        @else
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Unlimited uses</p>
                        @endif
                    </div>
                    <div>
                        <label class="text-xs text-gray-500 dark:text-gray-400 uppercase font-semibold">Total Discount Given</label>
                        <p class="text-3xl font-bold text-green-600 dark:text-green-400">
                            NPR {{ number_format($coupon->orders->sum('discount_amount'), 2) }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Restrictions Card -->
            <div class="bg-white dark:bg-slate-900 rounded-lg shadow-sm border border-gray-200 dark:border-slate-700 p-6">
                <h2 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Restrictions</h2>
                <div class="space-y-4">
                    <div>
                        <label class="text-xs text-gray-500 dark:text-gray-400 uppercase font-semibold">Minimum Purchase</label>
                        <p class="text-gray-900 dark:text-white font-medium">
                            {{ $coupon->min_purchase ? 'NPR ' . number_format($coupon->min_purchase / 100, 2) : 'None' }}
                        </p>
                    </div>
                    <div class="pt-4 border-t border-gray-100 dark:border-gray-800">
                        <div class="flex gap-2">
                            <a href="{{ route('admin.coupons.edit', $coupon->id) }}" class="flex-1 text-center px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600 transition-colors text-sm font-medium">
                                Edit Coupon
                            </a>
                            <button class="open-delete-modal flex-1 text-center px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition-colors text-sm font-medium">
                                Delete
                            </button>
                        </div>
                        <x-ui.delete-modal action="{{ route('admin.coupons.destroy', $coupon->id) }}" />
                    </div>
                </div>
            </div>
        </div>

        <!-- Orders List -->
        <div class="bg-white dark:bg-slate-900 rounded-lg shadow-sm border border-gray-200 dark:border-slate-700 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-slate-700">
                <h2 class="text-lg font-bold text-gray-900 dark:text-white">Orders using this coupon</h2>
            </div>
            
            @if($coupon->orders->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-slate-800">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Order ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Customer</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Order Total</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Discount</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-slate-900 divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach($coupon->orders as $order)
                                <tr class="hover:bg-gray-50 dark:hover:bg-slate-800 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-blue-600 dark:text-blue-400">
                                        #{{ $order->id }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                        {{ $order->user->name }}
                                        <div class="text-xs text-gray-500">{{ $order->user->email }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                        {{ $order->created_at->format('M d, Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                        NPR {{ number_format($order->total_amount, 2) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-green-600 dark:text-green-400">
                                        - NPR {{ number_format($order->discount_amount, 2) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full 
                                            {{ $order->status === 'completed' ? 'bg-green-100 text-green-800' : 
                                               ($order->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 
                                               ($order->status === 'cancelled' ? 'bg-red-100 text-red-800' : 'bg-gray-100 text-gray-800')) }}">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="{{ route('admin.orders.show', $order->id) }}" class="text-blue-600 hover:text-blue-900 dark:hover:text-blue-400">View</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="p-8 text-center text-gray-500 dark:text-gray-400">
                    No orders have used this coupon yet.
                </div>
            @endif
        </div>
    </div>
</x-layouts.admin>
