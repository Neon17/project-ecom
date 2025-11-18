<x-layouts.admin>
    <div class="max-w-2xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Create New Payment</h1>
            <a href="{{ route('admin.payments.index') }}" 
               class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition duration-200">
                Back to Payments
            </a>
        </div>

        <form action="{{ route('admin.payments.store') }}" method="POST" class="space-y-6">
            @csrf

            <div class="bg-white rounded-lg shadow border border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Payment Details</h2>
                
                <div class="space-y-4">
                    <!-- Order Selection -->
                    <div>
                        <label for="order_id" class="block text-sm font-medium text-gray-700 mb-2">Order *</label>
                        <select name="order_id" id="order_id" required
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Select an order</option>
                            @foreach($orders as $order)
                                <option value="{{ $order->id }}" {{ old('order_id') == $order->id ? 'selected' : '' }}>
                                    Order #{{ $order->id }} - {{ $order->user->name }} ({{ $order->user->email }})
                                </option>
                            @endforeach
                        </select>
                        @error('order_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Payment Method -->
                    <div>
                        <label for="payment_method" class="block text-sm font-medium text-gray-700 mb-2">Payment Method *</label>
                        <select name="payment_method" id="payment_method" required
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Select payment method</option>
                            @foreach($paymentMethods as $value => $label)
                                <option value="{{ $value }}" {{ old('payment_method') == $value ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                        @error('payment_method')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Transaction Code -->
                    <div>
                        <label for="transaction_code" class="block text-sm font-medium text-gray-700 mb-2">Transaction Code</label>
                        <input type="text" name="transaction_code" id="transaction_code" 
                               value="{{ old('transaction_code') }}"
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               placeholder="Enter transaction code">
                        @error('transaction_code')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status *</label>
                        <select name="status" id="status" required
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Select status</option>
                            @foreach($paymentStatuses as $value => $label)
                                <option value="{{ $value }}" {{ old('status', \App\Enums\PaymentStatusEnum::Pending->value) == $value ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                        @error('status')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="flex justify-end">
                <button type="submit" 
                        class="bg-blue-500 text-white px-6 py-3 rounded hover:bg-blue-600 transition duration-200">
                    Create Payment
                </button>
            </div>
        </form>
    </div>
</x-layouts.admin>