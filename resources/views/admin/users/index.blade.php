<x-layouts.admin>

    <div class="title text-2xl p-3">
        Users
    </div>

    <div class="button-wrapper py-3">
        <a href="{{ route('admin.users.create') }}"
            class="p-3 bg-blue-500 text-white inline m-3 hover:bg-blue-800 transition-all duration-300">Add User</a>
    </div>

    {{-- Table Design --}}
    <table class="table-fixed border-separate p-3 w-3/4 my-10">
        <thead class="bg-gray-200">
            <tr>
                <th class="w-1/6 border-r py-2">SN</th>
                <th class="w-1/6 border-r py-2">Name</th>
                <th class="w-1/6 border-r py-2">Email</th>
                <th class="w-1/6 border-r py-2">Address</th>
                <th class="w-1/6 border-r py-2">Total Orders</th>
                <th class="w-1/6 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="text-center p-2 px-5 border-r">1</td>
                <td class="text-center p-2 px-5 border-r">Shyam Gautam</td>
                <td class="text-center p-2 px-5 border-r">shyam@gmail.com</td>
                <td class="text-center p-2 px-5 border-r">Simalchaur, Pokhara</td>
                <td class="text-center p-2 px-5 border-r">5</td>
                <td class="text-center p-2 px-5 flex justify-center">
                    <a href="{{ route('admin.users.edit', 1) }}"
                        class="p-2 bg-yellow-500 text-white mx-2 rounded hover:bg-yellow-700 transition-all duration-300">Edit</a>
                    {{-- <a href="{{ route('admin.users.show', 1) }}"
                        class="p-2 bg-yellow-500 text-white mx-2 rounded hover:bg-yellow-700 transition-all duration-300">View</a> --}}
                    <button
                        class="open-delete-model p-2 bg-red-500 text-white mx-2 rounded hover:bg-red-700 duration-300 transaction-all">Delete</button>
                    {{-- <x-ui.delete-modal action="{{ route('admin.users.destroy', 1) }}" /> --}}
                    <x-ui.delete-modal />
                </td>
            </tr>
            <tr>
                <td class="text-center p-2 px-5 border-r">2</td>
                <td class="text-center p-2 px-5 border-r">Ramesh Pandey</td>
                 <td class="text-center p-2 px-5 border-r">ramesh@gmail.com</td>
                  <td class="text-center p-2 px-5 border-r">New Baneshwor</td>
                <td class="text-center p-2 px-5 border-r">3</td>
                <td class="text-center p-2 px-5 flex justify-center">
                    <a href="{{ route('admin.users.edit', 1) }}"
                        class="p-2 bg-yellow-500 text-white mx-2 rounded hover:bg-yellow-700 transition-all duration-300">Edit</a>
                    <button
                        class="p-2 bg-red-500 text-white mx-2 rounded transition-all duration-300 hover:bg-red-700">Delete</button>
                    <x-ui.delete-modal />
                </td>
            </tr>

        </tbody>

    </table>



</x-layouts.admin>
