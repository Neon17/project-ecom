<x-layouts.user>
    <div class="mb-8 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Order #{{ $order->id }}</h1>
            <p class="text-gray-600">Placed on {{ $order->created_at->format('M d, Y h:i A') }}</p>
        </div>
        <a href="{{ route('user.orders.index') }}" class="text-gray-600 hover:text-gray-900 flex items-center">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Back to Orders
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 space-y-6">
            <!-- Order Items -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100">
                    <h2 class="text-lg font-bold text-gray-800">Order Items</h2>
                </div>
                <div class="divide-y divide-gray-100">
                    @foreach($order->orderItems as $item)
                        <div class="p-6 flex items-center">
                            <img src="{{ $item->product->image_url ?? 'https://via.placeholder.com/100' }}" alt="{{ $item->product->name }}" class="w-20 h-20 object-cover rounded-lg mr-6">
                            <div class="flex-1">
                                <h3 class="font-medium text-gray-900">{{ $item->product->name }}</h3>
                                <p class="text-gray-500 text-sm">Quantity: {{ $item->quantity }}</p>
                            </div>
                            <div class="text-right">
                                <p class="font-bold text-gray-900">NPR {{ number_format($item->amount_per_item, 2) }}</p>
                                <p class="text-gray-500 text-sm">Total: NPR {{ number_format($item->amount_per_item * $item->quantity, 2) }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="bg-gray-50 px-6 py-4 border-t border-gray-100">
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-gray-600">Subtotal</span>
                        <span class="font-medium text-gray-900">NPR {{ number_format($order->orderItems->sum(fn($i) => $i->amount_per_item * $i->quantity), 2) }}</span>
                    </div>
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-gray-600">Tax</span>
                        <span class="font-medium text-gray-900">NPR {{ number_format($order->tax_amount, 2) }}</span>
                    </div>
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-gray-600">Service Charge</span>
                        <span class="font-medium text-gray-900">NPR {{ number_format($order->service_charge, 2) }}</span>
                    </div>
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-gray-600">Delivery Charge</span>
                        <span class="font-medium text-gray-900">NPR {{ number_format($order->delivery_charge, 2) }}</span>
                    </div>
                    <div class="flex justify-between items-center pt-2 border-t border-gray-200">
                        <span class="text-lg font-bold text-gray-900">Total</span>
                        <span class="text-lg font-bold text-blue-600">NPR {{ number_format($order->total, 2) }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="space-y-6">
            <!-- Order Status -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6">
                <h2 class="text-lg font-bold text-gray-800 mb-4">Order Status</h2>
                <div class="flex items-center mb-4">
                    <span class="px-3 py-1 rounded-full text-sm font-semibold
                        {{ $order->status === 'completed' ? 'bg-green-100 text-green-800' : 
                           ($order->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 
                           ($order->status === 'cancelled' ? 'bg-red-100 text-red-800' : 'bg-gray-100 text-gray-800')) }}">
                        {{ ucfirst($order->status) }}
                    </span>
                </div>
                @if($order->status === 'pending' && (!$order->payment || $order->payment->status !== \App\Enums\PaymentStatusEnum::Completed))
                    <a href="{{ route('orders.pay', $order) }}" class="block w-full bg-blue-600 hover:bg-blue-700 text-white text-center font-semibold py-2 rounded-lg transition-colors">
                        Pay Now
                    </a>
                @endif
            </div>

            <!-- Shipping Address -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6">
                <h2 class="text-lg font-bold text-gray-800 mb-4">Shipping Address</h2>
                @if($order->address)
                    <p class="text-gray-600">{{ $order->address->street_address_1 }}</p>
                    @if($order->address->street_address_2)
                        <p class="text-gray-600">{{ $order->address->street_address_2 }}</p>
                    @endif
                    <p class="text-gray-600">{{ $order->address->city }}, {{ $order->address->state }}</p>
                    <p class="text-gray-600">{{ $order->address->country }}</p>
                @else
                    <p class="text-gray-500 italic">No address information available.</p>
                @endif
            </div>

            <!-- Payment Info -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6">
                <h2 class="text-lg font-bold text-gray-800 mb-4">Payment Info</h2>
                @if($order->payment)
                    <div class="mb-2">
                        <span class="text-gray-500 text-sm">Method:</span>
                        <span class="font-medium text-gray-900">{{ ucfirst($order->payment->payment_method->value) }}</span>
                    </div>
                    <div class="mb-2">
                        <span class="text-gray-500 text-sm">Status:</span>
                        <span class="px-2 py-0.5 rounded text-xs font-semibold
                            {{ $order->payment->status === \App\Enums\PaymentStatusEnum::Completed ? 'bg-green-100 text-green-800' : 
                               ($order->payment->status === \App\Enums\PaymentStatusEnum::Pending ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                            {{ ucfirst($order->payment->status->value) }}
                        </span>
                    </div>
                    @if($order->payment->transaction_code)
                        <div>
                            <span class="text-gray-500 text-sm">Transaction ID:</span>
                            <span class="font-mono text-sm text-gray-700 block break-all">{{ $order->payment->transaction_code }}</span>
                        </div>
                    @endif
                @else
                    <p class="text-gray-500 italic">No payment information available.</p>
                @endif
            </div>
        </div>
    </div>
</x-layouts.user>