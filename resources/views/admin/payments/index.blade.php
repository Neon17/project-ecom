<x-layouts.admin>

    <div class="title text-2xl p-3">
        Payment
    </div>

    <div class="button-wrapper py-3">
        <a href="{{ route('admin.payments.create') }}"
            class="p-3 bg-blue-500 text-white inline m-3 hover:bg-blue-800 transition-all duration-300">Add Payment</a>
    </div>

    {{-- Table Design --}}
    <table class="table-fixed border-separate p-3 w-3/4 my-10">
        <thead class="bg-gray-200">
            <tr>
                <th class="w-1/6 border-r py-2">SN</th>
                <th class="w-1/6 border-r py-2">User Name</th>
                <th class="w-1/6 border-r py-2">Payment Method</th>
                <th class="w-1/6 border-r py-2">Transaction Code</th>
                <th class="w-1/6 border-r py-2">Status</th>
                <th class="w-1/6 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="text-center p-2 px-5 border-r">1</td>
                <td class="text-center p-2 px-5 border-r">Shyam Bahadur</td>
                <td class="text-center p-2 px-5 border-r">null</td>
                <td class="text-center p-2 px-5 border-r">null</td>
                <td class="text-center p-2 px-5 border-r">pending</td>
                <td class="text-center p-2 px-5 flex justify-center">
                    <a href="{{ route('admin.payments.edit', 1) }}"
                        class="p-2 bg-yellow-500 text-white mx-2 rounded hover:bg-yellow-700 transition-all duration-300">Edit</a>
                    {{-- <a href="{{ route('admin.payments.show', 1) }}"
                        class="p-2 bg-yellow-500 text-white mx-2 rounded hover:bg-yellow-700 transition-all duration-300">View</a> --}}
                    <button
                        class="open-delete-model p-2 bg-red-500 text-white mx-2 rounded hover:bg-red-700 duration-300 transaction-all">Delete</button>
                    {{-- <x-ui.delete-modal action="{{ route('admin.payments.destroy', 1) }}" /> --}}
                    <x-ui.delete-modal />
                </td>
            </tr>
            <tr>
                <td class="text-center p-2 px-5 border-r">2</td>
                <td class="text-center p-2 px-5 border-r">Ramesh Pandey</td>
                 <td class="text-center p-2 px-5 border-r">esewa</td>
                  <td class="text-center p-2 px-5 border-r">TXN43758345</td>
                <td class="text-center p-2 px-5 border-r">done</td>
                <td class="text-center p-2 px-5 flex justify-center">
                    <a href="{{ route('admin.payments.edit', 1) }}"
                        class="p-2 bg-yellow-500 text-white mx-2 rounded hover:bg-yellow-700 transition-all duration-300">Edit</a>
                    <button
                        class="p-2 bg-red-500 text-white mx-2 rounded transition-all duration-300 hover:bg-red-700">Delete</button>
                    <x-ui.delete-modal />
                </td>
            </tr>

        </tbody>

    </table>



</x-layouts.admin>
