<x-layouts.admin>

    <div class="flex justify-between">
        <div class="title text-2xl p-3">
            Payments
        </div>

        <div class="button-wrapper py-3">
            <a href="{{ route('admin.payments.create') }}"
                class="p-3 bg-blue-500 text-white inline m-3 hover:bg-blue-800 transition-all duration-300">Add Payment</a>
        </div>
    </div>

    @if (!$payments->isEmpty())
    <table class="min-w-full my-5">
        <thead class="bg-gray-200">
            <tr>
                <th class="w-1/6 py-2">SN</th>
                <th class="w-1/6 py-2">User Name</th>
                <th class="w-1/6 py-2">Order ID</th>
                <th class="w-1/6 py-2">Payment Method</th>
                <th class="w-1/6 py-2">Transaction Code</th>
                <th class="w-1/6 py-2">Status</th>
                <th class="w-1/6 py-2">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-300">
            @foreach ($payments as $payment)
                <tr class="table-row hover:bg-gray-50 transition-colors">
                    <td class="text-center p-2 px-5">{{$loop->iteration}}</td>
                    <td class="text-center p-2 px-5">{{$payment->order->user->name ?? 'N/A'}}</td>
                    <td class="text-center p-2 px-5">#{{$payment->order_id}}</td>
                    <td class="text-center p-2 px-5 capitalize">{{$payment->payment_method->value ?? 'N/A'}}</td>
                    <td class="text-center p-2 px-5">{{$payment->transaction_code ?? 'N/A'}}</td>
                    <td class="text-center p-2 px-5">
                        @php
                            $statusColors = [
                                'pending' => 'bg-yellow-100 text-yellow-800',
                                'completed' => 'bg-green-100 text-green-800',
                                'failed' => 'bg-red-100 text-red-800',
                            ];
                        @endphp
                        <span class="px-2 py-1 rounded-full text-xs font-medium {{ $statusColors[$payment->status->value] ?? 'bg-gray-100 text-gray-800' }} capitalize">
                            {{ $payment->status->value }}
                        </span>
                    </td>
                    <td class="text-center p-2 px-5 flex justify-center">
                        <a href="{{ route('admin.payments.edit', $payment->id) }}"
                            class="p-2 bg-yellow-500 text-white mx-2 rounded hover:bg-yellow-700 transition-all duration-300">Edit</a>
                        <a href="{{ route('users.orders.show', [$payment->order->user_id, $payment->order_id]) }}"
                            class="p-2 bg-green-500 text-white mx-2 rounded hover:bg-green-700 transition-all duration-300">View</a>
                        <button
                            class="open-delete-modal p-2 bg-red-500 text-white mx-2 rounded hover:bg-red-700 duration-300 transaction-all">Delete</button>
                        <x-ui.delete-modal action="{{ route('admin.payments.destroy', $payment->id) }}" />
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @else 
    <p class="text-center text-2xl text-gray-500 my-12">No Payments Found</p>
    @endif

</x-layouts.admin>