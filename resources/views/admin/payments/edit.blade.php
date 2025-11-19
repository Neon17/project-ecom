<x-layouts.admin>
    <div class="max-w-2xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-6">
            <a href="{{ route('admin.payments.index') }}" 
               class="inline-flex items-center text-blue-600 hover:text-blue-800 text-sm font-medium mb-4">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back to Payments
            </a>
            <h1 class="text-2xl font-bold text-gray-900">Edit Payment #{{ $payment->id }}</h1>
        </div>

        <form action="{{ route('admin.payments.update', $payment->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="bg-white rounded-lg border border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Payment Details</h2>
                
                <div class="space-y-4">
                    <!-- Order Information (Read-only) -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Order</label>
                        <div class="p-2 bg-gray-50 border border-gray-300 rounded-md text-gray-800 text-sm">
                            Order #{{ $payment->order_id }} - {{ $payment->order->user->name }}
                        </div>
                        <input type="hidden" name="order_id" value="{{ $payment->order_id }}">
                    </div>

                    <!-- Payment Method -->
                    <div>
                        <label for="payment_method" class="block text-sm font-medium text-gray-700 mb-1">Payment Method *</label>
                        <select name="payment_method" id="payment_method" required
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Select payment method</option>
                            @foreach($paymentMethods as $value => $label)
                                <option value="{{ $value }}" {{ $payment->payment_method->value == $value ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                        @error('payment_method')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Transaction Code -->
                    <div>
                        <label for="transaction_code" class="block text-sm font-medium text-gray-700 mb-1">Transaction Code</label>
                        <input type="text" name="transaction_code" id="transaction_code" 
                               value="{{ old('transaction_code', $payment->transaction_code) }}"
                               class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                               placeholder="Enter transaction code">
                        @error('transaction_code')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status *</label>
                        <select name="status" id="status" required
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Select status</option>
                            @foreach($paymentStatuses as $value => $label)
                                <option value="{{ $value }}" {{ $payment->status->value == $value ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                        @error('status')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="flex justify-end space-x-3 pt-2">
                <a href="{{ route('admin.payments.index') }}"
                   class="px-4 py-2 bg-gray-300 text-gray-800 rounded-md hover:bg-gray-400 font-medium">
                    Cancel
                </a>
                <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 font-medium">
                    Update Payment
                </button>
            </div>
        </form>
    </div>
</x-layouts.admin>