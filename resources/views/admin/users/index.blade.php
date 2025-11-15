<x-layouts.admin>

    <div class="title text-2xl p-3">
        Users
    </div>

    <div class="button-wrapper py-3">
        <a href="{{ route('admin.users.create') }}"
            class="p-3 bg-blue-500 text-white inline m-3 hover:bg-blue-800 transition-all duration-300">Add User</a>
    </div>

    @if ($users->count() > 0)
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
                @foreach ($users as $user)
                    <tr>
                        <td class="text-center p-2 px-5 border-r">{{$loop->iteration}}</td>
                        <td class="text-center p-2 px-5 border-r">{{$user->name}}</td>
                        <td class="text-center p-2 px-5 border-r">{{$user->email}}</td>
                        <td class="text-center p-2 px-5 border-r">{{$user->address}}</td>
                        <td class="text-center p-2 px-5 border-r">{{$user->orders->count()}}</td>
                        <td class="text-center p-2 px-5 flex">
                            <a href="{{ route('users.edit', $user->id) }}"
                                class="p-2 bg-yellow-500 text-white mx-1 rounded hover:bg-yellow-700 transition-all duration-300">Edit</a>
                            <a href="{{ route('users.show', $user->id) }}"
                                class="p-2 bg-yellow-500 text-white mx-1 rounded hover:bg-yellow-700 transition-all duration-300">View</a>
                            <button
                                class="open-delete-modal p-2 bg-red-500 text-white mx-1 rounded hover:bg-red-700 duration-300 transaction-all">Delete</button>
                            <x-ui.delete-modal action="{{ route('users.destroy', $user->id) }}" />
                            <x-ui.delete-modal />
                        </td>
                    </tr>
                @endforeach

            </tbody>

        </table>
    @else
        <p class="text-center text-2xl py-10 text-center">No Users Found</p>
    @endif



</x-layouts.admin>
