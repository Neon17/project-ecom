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

    {{-- Table Design --}}
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
            <tr class="table-row hover:bg-gray-50 transition-colors">
                <td class="text-center p-2 px-5">1</td>
                <td class="text-center p-2 px-5">Shyam Gautam</td>
                <td class="text-center p-2 px-5">Hemja</td>
                <td class="text-center p-2 px-5">pending</td>
                <td class="text-center p-2 px-5">processed</td>
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
            <tr class="table-row hover:bg-gray-50 transition-colors">
                <td class="text-center p-2 px-5">2</td>
                <td class="text-center p-2 px-5">Ramesh Pandey</td>
                <td class="text-center p-2 px-5">Tudikhel</td>
                <td class="text-center p-2 px-5">pending</td>
                <td class="text-center p-2 px-5">processed</td>
                <td class="text-center p-2 px-5 flex justify-center">
                    <a href="{{ route('admin.orders.edit', 1) }}"
                        class="p-2 bg-yellow-500 text-white mx-2 rounded hover:bg-yellow-700 transition-all duration-300">Edit</a>
                    <button
                        class="open-delete-modal p-2 bg-red-500 text-white mx-2 rounded transition-all duration-300 hover:bg-red-700">Delete</button>
                    <x-ui.delete-modal />
                </td>
            </tr>

        </tbody>

    </table>



</x-layouts.admin>
