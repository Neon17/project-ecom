<x-layouts.user>
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-800">My Orders</h1>
        <p class="text-gray-600">Track and manage your orders.</p>
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-4 mb-6">
        <form action="{{ route('user.orders.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Search</label>
                <input type="text" name="search" id="search" value="{{ request('search') }}" placeholder="Order ID"
                    class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-sm">
            </div>
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select name="status" id="status" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-sm">
                    <option value="">All Statuses</option>
                    @foreach(\App\Enums\OrderStatusEnum::cases() as $status)
                        <option value="{{ $status->value }}" {{ request('status') == $status->value ? 'selected' : '' }}>
                            {{ ucfirst($status->value) }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="flex items-end gap-2">
                <button type="submit" class="flex-1 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors text-sm font-medium">
                    Filter
                </button>
                <a href="{{ route('user.orders.index') }}" class="px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors text-sm font-medium">
                    Reset
                </a>
            </div>
        </form>
    </div>

    <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-gray-50 text-gray-600 text-sm uppercase tracking-wider">
                        <th class="px-6 py-3">Order ID</th>
                        <th class="px-6 py-3">Date</th>
                        <th class="px-6 py-3">Status</th>
                        <th class="px-6 py-3">Payment</th>
                        <th class="px-6 py-3">Total</th>
                        <th class="px-6 py-3">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($orders as $order)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 font-medium text-gray-900">#{{ $order->id }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $order->created_at->format('M d, Y') }}</td>
                            <td class="px-6 py-4">
                                <span
                                    class="px-3 py-1 rounded-full text-xs font-semibold
                                    {{ $order->status === 'completed'
                                        ? 'bg-green-100 text-green-800'
                                        : ($order->status === 'pending'
                                            ? 'bg-yellow-100 text-yellow-800'
                                            : ($order->status === 'cancelled'
                                                ? 'bg-red-100 text-red-800'
                                                : 'bg-gray-100 text-gray-800')) }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                @if ($order->payment)
                                    <span
                                        class="px-3 py-1 rounded-full text-xs font-semibold
                                        {{ $order->payment->status === \App\Enums\PaymentStatusEnum::Completed
                                            ? 'bg-green-100 text-green-800'
                                            : ($order->payment->status === \App\Enums\PaymentStatusEnum::Pending
                                                ? 'bg-yellow-100 text-yellow-800'
                                                : 'bg-red-100 text-red-800') }}">
                                        {{ ucfirst($order->payment->status->value) }}
                                    </span>
                                @else
                                    <span
                                        class="px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-800">Unpaid</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900">
                                NPR {{ number_format($order->total_amount / 100, 2) }}</td>
                            <td class="px-6 py-4">
                                <a href="{{ route('user.orders.show', $order) }}"
                                    class="text-blue-600 hover:text-blue-800 font-medium text-sm">View Details</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                                No orders found. <a href="{{ route('products.index') }}"
                                    class="text-blue-600 hover:underline">Start shopping</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-gray-100">
            {{ $orders->withQueryString()->links() }}
        </div>
    </div>
</x-layouts.user>
