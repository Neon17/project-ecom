<x-layouts.admin>
    <div class="max-w-2xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-6">
            <a href="{{ route('admin.payments.index') }}" 
               class="inline-flex items-center text-blue-600 dark:text-blue-400 hover:text-blue-800 text-sm font-medium mb-4">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back to Payments
            </a>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Create New Payment</h1>
        </div>

        <!-- Filter Form -->
        <div class="bg-gray-50 dark:bg-slate-800 rounded-lg p-4 mb-6 border border-gray-100 dark:border-gray-700">
            <form action="{{ route('admin.payments.create') }}" method="GET" class="flex flex-col md:flex-row gap-4">
                <div class="flex-1">
                    <label for="search" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Search Orders</label>
                    <input type="text" name="search" id="search" value="{{ request('search') }}" placeholder="Search by order ID, user name or email..."
                        class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-slate-700 dark:text-white focus:border-blue-500 focus:ring-blue-500 text-sm p-2">
                </div>
                <div>
                    <label for="filter" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Payment Status</label>
                    <select name="filter" id="filter" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-slate-700 dark:text-white focus:border-blue-500 focus:ring-blue-500 text-sm p-2">
                        <option value="">All Orders</option>
                        <option value="no_payment" {{ request('filter') === 'no_payment' ? 'selected' : '' }}>Without Payment</option>
                        <option value="has_payment" {{ request('filter') === 'has_payment' ? 'selected' : '' }}>With Payment</option>
                    </select>
                </div>
                <div class="flex items-end gap-2">
                    <button type="submit" class="bg-gray-800 dark:bg-gray-700 text-white px-4 py-2 rounded-lg hover:bg-gray-700 dark:hover:bg-gray-600 transition-colors text-sm font-medium">
                        Filter
                    </button>
                    <a href="{{ route('admin.payments.create') }}" class="px-4 py-2 bg-white dark:bg-slate-900 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-50 dark:hover:bg-slate-700 transition-colors text-sm font-medium">
                        Reset
                    </a>
                </div>
            </form>
        </div>

        <form action="{{ route('admin.payments.store') }}" method="POST" class="space-y-6">
            @csrf

            <div class="bg-white dark:bg-slate-900 rounded-lg border border-gray-200 dark:border-slate-700 p-6">
                <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Payment Details</h2>
                
                <div class="space-y-4">
                    <!-- Order Selection -->
                    <div>
                        <label for="order_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Order *</label>
                        <x-admin.order-search :orders="$orders" name="order_id" />
                        @error('order_id')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Payment Method -->
                    <div>
                        <label for="payment_method" class="block text-sm font-medium text-gray-700 dark:text-gray-300 dark:text-gray-600 mb-1">Payment Method *</label>
                        <select name="payment_method" id="payment_method" required
                                class="w-full border border-gray-300 dark:border-gray-600 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                            <option class="text-gray-700 dark:text-gray-300 dark:bg-gray-700" value="">Select payment method</option>
                            @foreach($paymentMethods as $value => $label)
                                <option class="text-gray-700 dark:text-gray-300 dark:bg-gray-700" value="{{ $value }}" {{ old('payment_method') == $value ? 'selected' : '' }}>
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
                        <label for="transaction_code" class="block text-sm font-medium text-gray-700 dark:text-gray-300 dark:text-gray-600 mb-1">Transaction Code</label>
                        <input type="text" name="transaction_code" id="transaction_code" 
                               value="{{ old('transaction_code') }}"
                               class="w-full border border-gray-300 dark:border-gray-600 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                               placeholder="Enter transaction code">
                        @error('transaction_code')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 dark:text-gray-600 mb-1">Status *</label>
                        <select name="status" id="status" required searchable="true"
                                class="w-full border border-gray-300 dark:border-gray-600 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Select status</option>
                            @foreach($paymentStatuses as $value => $label)
                                <option value="{{ $value }}" {{ old('status', \App\Enums\PaymentStatusEnum::Pending->value) == $value ? 'selected' : '' }}>
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

            <div class="flex justify-end pt-2">
                <button type="submit" 
                        class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 font-medium">
                    Create Payment
                </button>
            </div>
        </form>
    </div>
</x-layouts.admin>