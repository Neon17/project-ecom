<x-layouts.admin>
    <div class="bg-white dark:bg-slate-900 rounded-lg shadow-sm border border-gray-100 dark:border-gray-700 p-6 mb-8">
        <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200">Users Management</h1>
            <a href="{{ route('admin.users.create') }}"
                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-300 flex items-center gap-2 shadow-sm">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                </svg>
                <span>Add New User</span>
            </a>
        </div>

        <!-- Filters -->
        <div class="bg-gray-50 dark:bg-slate-800 rounded-lg p-4 mb-6 border border-gray-100 dark:border-gray-700">
            <form action="{{ route('admin.users.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label for="search" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Search</label>
                    <input type="text" name="search" id="search" value="{{ request('search') }}" placeholder="Name or Email"
                        class="w-full rounded-lg border-gray-300 dark:border-gray-600 focus:border-blue-500 focus:ring-blue-500 text-sm p-2">
                </div>
                <div>
                    <label for="role" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Role</label>
                    <select name="role" id="role" class="w-full rounded-lg border-gray-300 dark:border-gray-600 focus:border-blue-500 focus:ring-blue-500 text-sm">
                        <option value="">All Roles</option>
                        @foreach(\App\Enums\RoleEnum::cases() as $role)
                            <option class="text-gray-700 dark:text-gray-300 bg-white dark:bg-slate-800" value="{{ $role->value }}" {{ request('role') == $role->value ? 'selected' : '' }}>
                                {{ ucfirst($role->value) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="flex items-end gap-2">
                    <button type="submit" class="flex-1 bg-gray-800 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition-colors text-sm font-medium">
                        Filter
                    </button>
                    <a href="{{ route('admin.users.index') }}" class="px-4 py-2 bg-white dark:bg-slate-900 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-50 dark:hover:bg-slate-700 dark:bg-slate-800 transition-colors text-sm font-medium">
                        Reset
                    </a>
                </div>
            </form>
        </div>

        @if ($users->count() > 0)
            <div class="overflow-x-auto rounded-lg border border-gray-100 dark:border-gray-700">
                <table class="min-w-full divide-y divide-gray-200 [&_td]:px-6 [&_td]:py-3">
                    <thead class="bg-gray-50 dark:bg-slate-800">
                        <tr>
                            <th class="text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">SN</th>
                            <th class="text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">User</th>
                            <th class="text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Role</th>
                            <th class="text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Joined Date</th>
                            <th class="text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-slate-900 divide-y divide-gray-200">
                        @foreach ($users as $user)
                            <tr class="hover:bg-gray-50 dark:hover:bg-slate-700 dark:bg-slate-800 transition-colors">
                                <td class="whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">{{ $loop->iteration }}</td>
                                <td class="whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="h-10 w-10 rounded-full bg-gray-200 dark:bg-slate-700 flex items-center justify-center text-gray-500 dark:text-gray-400 font-bold text-lg">
                                            {{ substr($user->name, 0, 1) }}
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $user->name }}</div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400">{{ $user->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $user->role->value === 'admin' ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800' }}">
                                        {{ ucfirst($user->role->value) }}
                                    </span>
                                </td>
                                <td class="whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                    {{ $user->created_at->format('M d, Y') }}
                                </td>
                                <td class="whitespace-nowrap text-sm font-medium">
                                    <div class="flex items-center gap-3">
                                        <a href="{{ route('admin.users.show', $user->id) }}" class="text-gray-400 dark:text-gray-500 hover:text-blue-600 dark:text-blue-400 transition-colors" title="View">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                        </a>
                                        <a href="{{ route('admin.users.edit', $user->id) }}" class="text-gray-400 dark:text-gray-500 hover:text-yellow-600 transition-colors" title="Edit">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                        </a>
                                        <button class="open-delete-modal text-gray-400 dark:text-gray-500 hover:text-red-600 transition-colors" title="Delete">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                        <x-ui.delete-modal action="{{ route('admin.users.destroy', $user->id) }}" />
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $users->withQueryString()->links() }}
            </div>
        @else
            <div class="text-center py-12 bg-gray-50 dark:bg-slate-800 rounded-lg border border-gray-100 dark:border-gray-700">
                <svg class="mx-auto h-12 w-12 text-gray-400 dark:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">No users found</h3>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Try adjusting your search or filter to find what you're looking for.</p>
                <div class="mt-6">
                    <a href="{{ route('admin.users.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Add New User
                    </a>
                </div>
            </div>
        @endif
    </div>
</x-layouts.admin>
