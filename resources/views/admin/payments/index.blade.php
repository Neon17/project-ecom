<x-layouts.admin>

    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-900">Payments Management</h1>
            <a href="{{ route('admin.payments.create') }}"
                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors duration-300 flex items-center space-x-2">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                <span>Add New Payment</span>
            </a>
        </div>

        @if (!$payments->isEmpty())
            <div class="overflow-x-auto">
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr class="bg-gray-100 border-b border-gray-200">
                            <th class="px-5 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">SN</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">User Name</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Order ID</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Payment Method</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Transaction Code</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($payments as $payment)
                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                <td class="px-5 py-5 text-sm text-gray-800">{{$loop->iteration}}</td>
                                <td class="px-5 py-5 text-sm text-gray-800">{{$payment->order->user->name ?? 'N/A'}}</td>
                                <td class="px-5 py-5 text-sm text-gray-800">#{{$payment->order_id}}</td>
                                <td class="px-5 py-5 text-sm text-gray-800 capitalize">{{$payment->payment_method->value ?? 'N/A'}}</td>
                                <td class="px-5 py-5 text-sm text-gray-800">{{$payment->transaction_code ?? 'N/A'}}</td>
                                <td class="px-5 py-5 text-sm">
                                    @php
                                        $statusColors = [
                                            'pending' => 'bg-yellow-100 text-yellow-800',
                                            'completed' => 'bg-green-100 text-green-800',
                                            'failed' => 'bg-red-100 text-red-800',
                                        ];
                                    @endphp
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusColors[$payment->status->value] ?? 'bg-gray-100 text-gray-800' }} capitalize">
                                        {{ $payment->status->value }}
                                    </span>
                                </td>
                                <td class="px-5 py-5 text-sm text-gray-800">
                                    <div class="flex items-center space-x-3">
                                        <a href="{{ route('admin.payments.edit', $payment->id) }}"
                                            class="text-blue-600 hover:text-blue-900 transition-colors duration-200">
                                            Edit
                                        </a>
                                        <a href="{{ route('users.orders.show', [$payment->order->user_id, $payment->order_id]) }}"
                                            class="text-green-600 hover:text-green-900 transition-colors duration-200">
                                                View
                                        </a>
                                        <button class="open-delete-modal text-red-600 hover:text-red-900 transition-colors duration-200">
                                            Delete
                                        </button>
                                        <x-ui.delete-modal action="{{ route('admin.payments.destroy', $payment->id) }}" />
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else 
            <p class="text-center text-xl text-gray-500 py-10 bg-gray-50 rounded-lg">No payments found.</p>
        @endif
    </div>
</x-layouts.admin>