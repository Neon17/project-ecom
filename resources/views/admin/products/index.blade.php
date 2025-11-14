<x-layouts.admin>

    <div class="title text-2xl p-3">
        Products
    </div>

    <div class="button-wrapper py-3">
        <a href="{{ route('admin.products.create') }}"
            class="p-3 bg-blue-500 text-white inline m-3 hover:bg-blue-800 transition-all duration-300">Add Products</a>
    </div>

    {{-- Table Design --}}
    <table class="table-fixed border-separate p-3 w-3/4 my-10">
        <thead class="bg-gray-200">
            <tr>
                <th class="w-1/6 border-r py-2">SN</th>
                <th class="w-1/6 border-r py-2">Name</th>
                <th class="w-1/6 border-r py-2">Price</th>
                <th class="w-1/6 border-r py-2">Quantity</th>
                <th class="w-1/6 border-r py-2">Description</th>
                <th class="w-1/6 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="text-center p-2 px-5 border-r">1</td>
                <td class="text-center p-2 px-5 border-r">Laptop</td>
                <td class="text-center p-2 px-5 border-r">150K</td>
                <td class="text-center p-2 px-5 border-r">1</td>
                <td class="text-center p-2 px-5 border-r">This laptop powers dedicated GPU...</td>
                <td class="text-center p-2 px-5 flex justify-center">
                    <a href="{{ route('admin.products.edit', 1) }}"
                        class="p-2 bg-yellow-500 text-white mx-2 rounded hover:bg-yellow-700 transition-all duration-300">Edit</a>
                    {{-- <a href="{{ route('admin.products.show', 1) }}"
                        class="p-2 bg-yellow-500 text-white mx-2 rounded hover:bg-yellow-700 transition-all duration-300">View</a> --}}
                    <button
                        class="open-delete-model p-2 bg-red-500 text-white mx-2 rounded hover:bg-red-700 duration-300 transaction-all">Delete</button>
                    {{-- <x-ui.delete-modal action="{{ route('admin.products.destroy', 1) }}" /> --}}
                    <x-ui.delete-modal />
                </td>
            </tr>
            <tr>
                <td class="text-center p-2 px-5 border-r">2</td>
                <td class="text-center p-2 px-5 border-r">Mobile</td>
                 <td class="text-center p-2 px-5 border-r">40K</td>
                  <td class="text-center p-2 px-5 border-r">2</td>
                <td class="text-center p-2 px-5 border-r">This mobile have stunning camera...</td>
                <td class="text-center p-2 px-5 flex justify-center">
                    <a href="{{ route('admin.products.edit', 1) }}"
                        class="p-2 bg-yellow-500 text-white mx-2 rounded hover:bg-yellow-700 transition-all duration-300">Edit</a>
                    <button
                        class="p-2 bg-red-500 text-white mx-2 rounded transition-all duration-300 hover:bg-red-700">Delete</button>
                    <x-ui.delete-modal />
                </td>
            </tr>

        </tbody>

    </table>



</x-layouts.admin>
