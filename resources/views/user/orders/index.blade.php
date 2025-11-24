<x-layouts.user>
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-800">My Orders</h1>
        <p class="text-gray-600">Track and manage your orders.</p>
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
                                ${{ number_format($order->total_amount ?? 0, 2) }}</td>
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
            {{ $orders->links() }}
        </div>
    </div>
</x-layouts.user>
