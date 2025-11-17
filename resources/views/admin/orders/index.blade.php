<x-layouts.admin>

    <div class="flex justify-between">
        <div class="title text-2xl p-3">
            Orders
        </div>

        <div class="button-wrapper py-3">
            <a href="{{ route('admin.orders.create') }}"
                class="p-3 bg-blue-500 text-white inline m-3 hover:bg-blue-800 transition-all duration-300">Add Order</a>
        </div>
    </div>

    @if (!$orders->isEmpty())
    <table class="min-w-full my-5">
        <thead class="bg-gray-200">
            <tr>
                <th class="w-1/6 py-2">SN</th>
                <th class="w-1/6 py-2">User Name</th>
                <th class="w-1/6 py-2">Address</th>
                <th class="w-1/6 py-2">Payment Status</th>
                <th class="w-1/6 py-2">Order Status</th>
                <th class="w-1/6 py-2">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-300">
            @foreach ($orders as $order)

                <tr class="table-row hover:bg-gray-50 transition-colors">
                    <td class="text-center p-2 px-5">{{$loop->iteration}}</td>
                    <td class="text-center p-2 px-5">{{$order->user->name}}</td>
                    <td class="text-center p-2 px-5">{{$order->address->city}}</td>
                    <td class="text-center p-2 px-5">{{$order->payment_status??'null'}}</td>
                    <td class="text-center p-2 px-5">{{$order->order_status??'null'}}</td>
                    <td class="text-center p-2 px-5 flex justify-center">
                        <a href="{{ route('admin.orders.edit', 1) }}"
                            class="p-2 bg-yellow-500 text-white mx-2 rounded hover:bg-yellow-700 transition-all duration-300">Edit</a>
                        {{-- <a href="{{ route('admin.orders.show', 1) }}"
                            class="p-2 bg-yellow-500 text-white mx-2 rounded hover:bg-yellow-700 transition-all duration-300">View</a> --}}
                        <button
                            class="open-delete-modal p-2 bg-red-500 text-white mx-2 rounded hover:bg-red-700 duration-300 transaction-all">Delete</button>
                        {{-- <x-ui.delete-modal action="{{ route('admin.orders.destroy', 1) }}" /> --}}
                        <x-ui.delete-modal />
                    </td>
                </tr>

            @endforeach

        </tbody>

    </table>
    @else 
    <p class="text-center text-2xl text-gray-500 my-12">No Order Found</p>
    @endif



</x-layouts.admin>
