<x-layouts.admin>
    <div class="mb-6">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Coupons</h1>
                <p class="text-gray-600 dark:text-gray-300 mt-1">Manage discount coupons for your store</p>
            </div>
            <a href="{{ route('admin.coupons.create') }}"
                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                <i class="fas fa-plus mr-2"></i>Add New Coupon
            </a>
        </div>
    </div>

    <!-- Search Form -->
    <div class="bg-gray-50 dark:bg-slate-800 rounded-lg p-4 mb-6 border border-gray-100 dark:border-gray-700">
        <form action="{{ route('admin.coupons.index') }}" method="GET" class="flex flex-col md:flex-row gap-4">
            <div class="flex-1">
                <label for="search" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Search</label>
                <input type="text" name="search" id="search" value="{{ request('search') }}" placeholder="Search by coupon code..."
                    class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-slate-700 dark:text-white focus:border-blue-500 focus:ring-blue-500 text-sm p-2">
            </div>
            <div class="flex items-end gap-2">
                <button type="submit" class="bg-gray-800 dark:bg-gray-700 text-white px-4 py-2 rounded-lg hover:bg-gray-700 dark:hover:bg-gray-600 transition-colors text-sm font-medium">
                    Search
                </button>
                <a href="{{ route('admin.coupons.index') }}" class="px-4 py-2 bg-white dark:bg-slate-900 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-50 dark:hover:bg-slate-700 transition-colors text-sm font-medium">
                    Reset
                </a>
            </div>
        </form>
    </div>

    <div class="bg-white dark:bg-slate-900 rounded-lg shadow-sm border border-gray-200 dark:border-slate-700 overflow-hidden">
        @if ($coupons->count() > 0)
            <!-- Desktop Table -->
            <div class="hidden md:block overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-slate-800">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Code</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Type</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Value</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Usage</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Expires</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-slate-900 divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach ($coupons as $coupon)
                            <tr class="hover:bg-gray-50 dark:hover:bg-slate-800 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-bold text-gray-900 dark:text-white font-mono">{{ $coupon->code }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $coupon->type === 'percentage' ? 'bg-purple-100 text-purple-800' : 'bg-green-100 text-green-800' }}">
                                        {{ ucfirst($coupon->type) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white font-semibold">
                                    {{ $coupon->type === 'percentage' ? $coupon->value . '%' : 'NPR ' . number_format($coupon->value, 2) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                    {{ $coupon->used_count }}{{ $coupon->max_uses ? ' / ' . $coupon->max_uses : '' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                    {{ $coupon->expires_at ? $coupon->expires_at->format('M d, Y') : 'Never' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($coupon->isValid())
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                                    @else
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Inactive</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex items-center gap-3">
                                        <a href="{{ route('admin.coupons.edit', $coupon->id) }}" class="text-yellow-600 hover:text-yellow-700" title="Edit">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                        </a>
                                        <button class="open-delete-modal text-red-600 hover:text-red-700" title="Delete">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                        <x-ui.delete-modal action="{{ route('admin.coupons.destroy', $coupon->id) }}" />
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Mobile Cards -->
            <div class="md:hidden space-y-4 p-4">
                @foreach ($coupons as $coupon)
                    <div class="bg-white dark:bg-slate-900 rounded-lg border border-gray-200 dark:border-gray-700 p-4">
                        <div class="flex justify-between items-start mb-3">
                            <div class="font-bold text-lg font-mono text-gray-900 dark:text-white">{{ $coupon->code }}</div>
                            @if($coupon->isValid())
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                            @else
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Inactive</span>
                            @endif
                        </div>
                        <div class="space-y-2 text-sm mb-3">
                            <div class="flex justify-between">
                                <span class="text-gray-500 dark:text-gray-400">Type:</span>
                                <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $coupon->type === 'percentage' ? 'bg-purple-100 text-purple-800' : 'bg-green-100 text-green-800' }}">
                                    {{ ucfirst($coupon->type) }}
                                </span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500 dark:text-gray-400">Value:</span>
                                <span class="font-semibold text-gray-900 dark:text-white">
                                    {{ $coupon->type === 'percentage' ? $coupon->value . '%' : 'NPR ' . number_format($coupon->value, 2) }}
                                </span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500 dark:text-gray-400">Usage:</span>
                                <span class="text-gray-900 dark:text-white">{{ $coupon->used_count }}{{ $coupon->max_uses ? ' / ' . $coupon->max_uses : '' }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500 dark:text-gray-400">Expires:</span>
                                <span class="text-gray-900 dark:text-white">{{ $coupon->expires_at ? $coupon->expires_at->format('M d, Y') : 'Never' }}</span>
                            </div>
                        </div>
                        <div class="flex justify-end gap-3 pt-3 border-t border-gray-200 dark:border-gray-700">
                            <a href="{{ route('admin.coupons.edit', $coupon->id) }}" class="p-2 text-yellow-600 hover:text-yellow-700">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            </a>
                            <button class="open-delete-modal p-2 text-red-600 hover:text-red-700">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                            <x-ui.delete-modal action="{{ route('admin.coupons.destroy', $coupon->id) }}" />
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="px-6 py-4 border-t border-gray-200 dark:border-slate-700">
                {{ $coupons->withQueryString()->links() }}
            </div>
        @else
            <div class="p-12 text-center">
                <svg class="w-16 h-16 text-gray-300 dark:text-gray-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">No coupons yet</h3>
                <p class="text-gray-500 dark:text-gray-400 mb-4">Create your first coupon to offer discounts to customers.</p>
                <a href="{{ route('admin.coupons.create') }}"
                    class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                    <i class="fas fa-plus mr-2"></i>Create Coupon
                </a>
            </div>
        @endif
    </div>
</x-layouts.admin>
