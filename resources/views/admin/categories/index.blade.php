<x-layouts.admin>

    <div class="title text-2xl p-3">
        Categories
    </div>

    <div class="button-wrapper py-3">
        <a href="{{ route('admin.categories.create') }}"
            class="p-3 bg-blue-500 text-white inline m-3 hover:bg-blue-800 transition-all duration-300">Add Category</a>
    </div>

    {{-- Table Design --}}
    <table class="table-fixed border-separate p-3 w-3/4 my-10">
        <thead class="bg-gray-200">
            <tr>
                <th class="w-1/4 border-r py-2">SN</th>
                <th class="w-1/4 border-r py-2">Name</th>
                <th class="w-1/4 border-r py-2">Slug</th>
                <th class="w-1/4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="text-center p-2 px-5 border-r">1</td>
                <td class="text-center p-2 px-5 border-r">Electronic</td>
                <td class="text-center p-2 px-5 border-r">/electronic-products</td>
                <td class="text-center p-2 px-5 border-r flex justify-center">
                    <a href="{{ route('admin.categories.edit', 1) }}"
                        class="p-2 bg-yellow-500 text-white mx-2 rounded hover:bg-yellow-700 transition-all duration-300">Edit</a>
                    <button
                        class="open-delete-model p-2 bg-red-500 text-white mx-2 rounded hover:bg-red-700 duration-300 transaction-all">Delete</button>
                    {{-- <x-ui.delete-modal action="{{ route('admin.categories.destroy', 1) }}" /> --}}
                    <x-ui.delete-modal />
                </td>
            </tr>
            <tr>
                <td class="text-center p-2 px-5 border-r">2</td>
                <td class="text-center p-2 px-5 border-r">Gadgets</td>
                <td class="text-center p-2 px-5 border-r">/gadgets-products</td>
                <td class="text-center p-2 px-5 border-r flex justify-center">
                    <a href="{{ route('admin.categories.edit', 1) }}"
                        class="p-2 bg-yellow-500 text-white mx-2 rounded hover:bg-yellow-700 transition-all duration-300">Edit</a>
                    <button
                        class="p-2 bg-red-500 text-white mx-2 rounded transition-all duration-300 hover:bg-red-700">Delete</button>
                    <x-ui.delete-modal />
                </td>
            </tr>

        </tbody>

    </table>



</x-layouts.admin>
