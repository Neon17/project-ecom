<x-layouts.admin>

    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-900">Users Management</h1>
            <a href="{{ route('admin.users.create') }}"
                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors duration-300 flex items-center space-x-2">
                <span>Add New User</span>
            </a>
        </div>

        @if ($users->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr class="bg-gray-100 border-b border-gray-200">
                            <th class="px-5 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">SN</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Name</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Email</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Address</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Total Orders</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($users as $user)
                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                <td class="px-5 py-5 text-sm text-gray-800">{{ $loop->iteration }}</td>
                                <td class="px-5 py-5 text-sm text-gray-800">{{ $user->name }}</td>
                                <td class="px-5 py-5 text-sm text-gray-800">{{ $user->email }}</td>
                                <td class="px-5 py-5 text-sm text-gray-800">{{ $user->address ?? 'N/A' }}</td>
                                <td class="px-5 py-5 text-sm text-gray-800">{{ $user->orders->count() }}</td>
                                <td class="px-5 py-5 text-sm text-gray-800">
                                    <div class="flex items-center space-x-3">
                                        <a href="{{ route('users.show', $user->id) }}"
                                            class="text-green-600 hover:text-green-900 transition-colors duration-200">
                                                View
                                        </a>
                                        <a href="{{ route('users.edit', $user->id) }}"
                                            class="text-blue-600 hover:text-blue-900 transition-colors duration-200">
                                                Edit
                                        </a>
                                        <button
                                            class="open-delete-modal text-red-600 hover:text-red-900 transition-colors duration-200">
                                                Delete
                                        </button>
                                        <x-ui.delete-modal action="{{ route('users.destroy', $user->id) }}" />
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-center text-xl text-gray-500 py-10 bg-gray-50 rounded-lg">No users found.</p>
        @endif
    </div>


</x-layouts.admin>
