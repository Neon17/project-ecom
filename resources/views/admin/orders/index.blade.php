<x-layouts.admin>

    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-900">Orders Management</h1>
            <a href="{{ route('admin.orders.create') }}"
                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors duration-300 flex items-center space-x-2">
                <span>Add New Order</span>
            </a>
        </div>

        @if (!$orders->isEmpty())
            <div class="overflow-x-auto">
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr class="bg-gray-100 border-b border-gray-200">
                            <th class="px-5 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">SN</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">User Name</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Address</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Payment Status</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Order Status</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($orders as $order)
                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                <td class="px-5 py-5 text-sm text-gray-800">{{$loop->iteration}}</td>
                                <td class="px-5 py-5 text-sm text-gray-800">{{$order->user->name}}</td>
                                <td class="px-5 py-5 text-sm text-gray-800">{{$order->address->city}}</td>
                                <td class="px-5 py-5 text-sm">
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $order->payment?->status->value === 'completed' ? 'bg-green-100 text-green-800' : ($order->payment?->status->value === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                        {{$order->payment?->status->value??'N/A'}}
                                    </span>
                                </td>
                                <td class="px-5 py-5 text-sm">
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $order->status === 'completed' ? 'bg-green-100 text-green-800' : ($order->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : ($order->status === 'processing' ? 'bg-blue-100 text-blue-800' : 'bg-red-100 text-red-800')) }}">
                                        {{$order->status??'N/A'}}
                                    </span>
                                </td>
                                <td class="px-5 py-5 text-sm text-gray-800">
                                    <div class="flex items-center space-x-3">
                                        <a href="{{ route('users.orders.edit', ['order' => $order->id, 'user' => $order->user->id] ) }}"
                                            class="text-blue-600 hover:text-blue-900 transition-colors duration-200">
                                            Edit
                                        </a>
                                        <a href="{{ route('users.orders.show', ['order' => $order->id, 'user' => $order->user->id]) }}"
                                            class="text-green-600 hover:text-green-900 transition-colors duration-200">
                                           View
                                        </a>
                                        <button class="open-delete-modal text-red-600 hover:text-red-900 transition-colors duration-200">
                                            Delete
                                        </button>
                                        <x-ui.delete-modal action="{{ route('users.orders.destroy', ['order' => $order->id, 'user' => $order->user->id]) }}" />
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else 
            <p class="text-center text-xl text-gray-500 py-10 bg-gray-50 rounded-lg">No orders found.</p>
        @endif
    </div>


</x-layouts.admin>
