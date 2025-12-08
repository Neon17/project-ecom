<x-layouts.admin>
    <div class="bg-white dark:bg-slate-900 dark:bg-slate-700 dark:bg-slate-900 rounded-lg shadow-sm border border-gray-100 dark:border-gray-700 dark:border-gray-700 p-6 mb-8">
        <!-- Header Section -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8">
            <div class="mb-4 sm:mb-0">
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white dark:text-white">Address Management</h1>
                <p class="text-gray-600 dark:text-gray-300 dark:text-gray-600 dark:text-gray-300 dark:text-gray-600 dark:text-gray-300 dark:text-gray-600 mt-2">Manage and view all customer addresses</p>
            </div>
        </div>

        <!-- Search Form -->
        <div class="bg-gray-50 dark:bg-slate-800 rounded-lg p-4 mb-6 border border-gray-100 dark:border-gray-700">
            <form action="{{ route('admin.addresses.all') }}" method="GET" class="flex flex-col md:flex-row gap-4">
                <div class="flex-1">
                    <label for="search" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Search</label>
                    <input type="text" name="search" id="search" value="{{ request('search') }}" placeholder="Search by user, city, country, state..."
                        class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-slate-700 dark:text-white focus:border-blue-500 focus:ring-blue-500 text-sm p-2">
                </div>
                <div class="flex items-end gap-2">
                    <button type="submit" class="bg-gray-800 dark:bg-gray-700 text-white px-4 py-2 rounded-lg hover:bg-gray-700 dark:hover:bg-gray-600 transition-colors text-sm font-medium">
                        Search
                    </button>
                    <a href="{{ route('admin.addresses.all') }}" class="px-4 py-2 bg-white dark:bg-slate-900 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-50 dark:hover:bg-slate-700 transition-colors text-sm font-medium">
                        Reset
                    </a>
                </div>
            </form>
        </div>

        @if (!$addresses->isEmpty())
            <!-- Table Section -->
            <div class="overflow-x-auto rounded-lg border border-gray-200 dark:border-slate-700 dark:border-slate-700">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50 dark:bg-slate-800 dark:bg-slate-800">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 dark:text-gray-500 dark:text-gray-400 dark:text-gray-500 dark:text-gray-400 dark:text-gray-500 uppercase tracking-wider">
                                SN
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 dark:text-gray-500 dark:text-gray-400 dark:text-gray-500 dark:text-gray-400 dark:text-gray-500 uppercase tracking-wider">
                                User
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 dark:text-gray-500 dark:text-gray-400 dark:text-gray-500 dark:text-gray-400 dark:text-gray-500 uppercase tracking-wider">
                                Country
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 dark:text-gray-500 dark:text-gray-400 dark:text-gray-500 dark:text-gray-400 dark:text-gray-500 uppercase tracking-wider">
                                City
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 dark:text-gray-500 dark:text-gray-400 dark:text-gray-500 dark:text-gray-400 dark:text-gray-500 uppercase tracking-wider">
                                State
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 dark:text-gray-500 dark:text-gray-400 dark:text-gray-500 dark:text-gray-400 dark:text-gray-500 uppercase tracking-wider">
                                Street Address
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 dark:text-gray-500 dark:text-gray-400 dark:text-gray-500 dark:text-gray-400 dark:text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-slate-900 dark:bg-slate-900 divide-y divide-gray-200">
                        @foreach ($addresses as $address)
                            <tr class="hover:bg-gray-50 dark:hover:bg-slate-700 dark:bg-slate-800 dark:hover:bg-slate-700 dark:bg-slate-800 dark:hover:bg-slate-700 dark:bg-slate-800 transition-colors duration-150">
                                <td class="px-4 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white dark:text-white">
                                    {{ ($addresses->currentPage() - 1) * $addresses->perPage() + $loop->iteration }}
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div
                                            class="flex-shrink-0 h-8 w-8 bg-blue-100 rounded-full flex items-center justify-center">
                                            <span
                                                class="text-blue-600 dark:text-blue-400 dark:text-blue-400 font-semibold text-sm">{{ substr($address->user->name, 0, 1) }}</span>
                                        </div>
                                        <div class="ml-3">
                                            <div class="text-sm font-medium text-gray-900 dark:text-white dark:text-white">{{ $address->user->name }}
                                            </div>
                                            <div class="text-xs text-gray-500 dark:text-gray-400 dark:text-gray-500 dark:text-gray-400 dark:text-gray-500 dark:text-gray-400 dark:text-gray-500">{{ $address->user->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white dark:text-white">
                                    {{ $address->country }}
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white dark:text-white">
                                    {{ $address->city }}
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white dark:text-white">
                                    {{ $address->state ?? 'N/A' }}
                                </td>
                                <td class="px-4 py-4">
                                    <div class="text-sm text-gray-900 dark:text-white dark:text-white max-w-[150px] truncate"
                                        title="{{ $address->street_address_1 }}">
                                        {{ \Illuminate\Support\Str::words($address->street_address_1, 3, '...') }}
                                    </div>
                                    @if ($address->street_address_2)
                                        <div class="text-xs text-gray-500 dark:text-gray-400 dark:text-gray-500 dark:text-gray-400 dark:text-gray-500 dark:text-gray-400 dark:text-gray-500 max-w-[150px] truncate"
                                            title="{{ $address->street_address_2 }}">
                                            {{ \Illuminate\Support\Str::words($address->street_address_2, 2, '...') }}
                                        </div>
                                    @endif
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('admin.addresses.show', $address->id) }}" class="text-blue-600 dark:text-blue-400 hover:text-blue-900 transition duration-150"
                                            title="View Details">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <button class="text-green-600 hover:text-green-900 transition duration-150"
                                            title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="text-red-600 hover:text-red-900 transition duration-150"
                                            title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $addresses->withQueryString()->links() }}
            </div>
        @else
            <!-- Empty State -->
            <div class="bg-white dark:bg-slate-900 dark:bg-slate-700 dark:bg-slate-900 rounded-xl shadow-sm border border-gray-200 dark:border-slate-700 dark:border-slate-700 p-12 text-center">
                <div class="max-w-md mx-auto">
                    <div class="w-24 h-24 mx-auto mb-6 bg-gray-100 dark:bg-slate-800 dark:bg-slate-800 rounded-full flex items-center justify-center">
                        <i class="fas fa-map-marker-alt text-gray-400 dark:text-gray-500 dark:text-gray-400 dark:text-gray-500 dark:text-gray-400 dark:text-gray-500 text-3xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white dark:text-white mb-2">No Addresses Found</h3>
                    <p class="text-gray-600 dark:text-gray-300 dark:text-gray-600 dark:text-gray-300 dark:text-gray-600 dark:text-gray-300 dark:text-gray-600 mb-6">There are no addresses in the system yet. Start by adding the first
                        address.</p>
                    <button
                        class="bg-blue-600 hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600 dark:bg-blue-500 dark:hover:bg-blue-600 text-white px-6 py-3 rounded-lg transition duration-200 inline-flex items-center">
                        <i class="fas fa-plus mr-2"></i>
                        Add First Address
                    </button>
                </div>
            </div>
        @endif
    </div>
</x-layouts.admin>
