<x-layouts.admin>
    <div class="p-6">
        <!-- Header Section -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8">
            <div class="mb-4 sm:mb-0">
                <h1 class="text-3xl font-bold text-gray-900">Address Management</h1>
                <p class="text-gray-600 mt-2">Manage and view all customer addresses</p>
            </div>
            <div class="flex space-x-3">
                <button
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition duration-200 flex items-center">
                    <i class="fas fa-download mr-2"></i>
                    Export CSV
                </button>
                <button
                    class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition duration-200 flex items-center">
                    <i class="fas fa-plus mr-2"></i>
                    Add Address
                </button>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-lg bg-blue-100">
                        <i class="fas fa-map-marker-alt text-blue-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Total Addresses</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $addresses->count() }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-lg bg-green-100">
                        <i class="fas fa-users text-green-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Unique Users</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $addresses->unique('user_id')->count() }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-lg bg-purple-100">
                        <i class="fas fa-globe text-purple-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Countries</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $addresses->unique('country')->count() }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-lg bg-orange-100">
                        <i class="fas fa-city text-orange-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Cities</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $addresses->unique('city')->count() }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Search and Filters -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-4 sm:space-y-0">
                <div class="relative w-full sm:w-64">
                    <input type="text" placeholder="Search addresses..."
                        class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                </div>
                <div class="flex space-x-3 w-full sm:w-auto">
                    <select
                        class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent w-full sm:w-auto">
                        <option>All Countries</option>
                        @foreach ($addresses->unique('country') as $address)
                            <option>{{ $address->country }}</option>
                        @endforeach
                    </select>
                    <select
                        class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent w-full sm:w-auto">
                        <option>All Cities</option>
                        @foreach ($addresses->unique('city') as $address)
                            <option>{{ $address->city }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        @if (!$addresses->isEmpty())
            <!-- Table Section -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <div class="flex items-center">
                                        <span>SN</span>
                                        <i class="fas fa-sort ml-2 text-gray-400 cursor-pointer"></i>
                                    </div>
                                </th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <div class="flex items-center">
                                        <span>User</span>
                                        <i class="fas fa-sort ml-2 text-gray-400 cursor-pointer"></i>
                                    </div>
                                </th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Country
                                </th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    City
                                </th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    State
                                </th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Street Address
                                </th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($addresses as $address)
                                <tr class="hover:bg-gray-50 transition-colors duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="text-sm font-medium text-gray-900">{{ $loop->iteration }}</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div
                                                class="flex-shrink-0 h-10 w-10 bg-blue-100 rounded-full flex items-center justify-center">
                                                <span
                                                    class="text-blue-600 font-semibold">{{ substr($address->user->name, 0, 1) }}</span>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $address->user->name }}</div>
                                                <div class="text-sm text-gray-500">{{ $address->user->email }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <i class="fas fa-flag text-gray-400 mr-2"></i>
                                            <span class="text-sm text-gray-900">{{ $address->country }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <i class="fas fa-building text-gray-400 mr-2"></i>
                                            <span class="text-sm text-gray-900">{{ $address->city }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="text-sm text-gray-900">{{ $address->state ?? 'N/A' }}</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-900 max-w-xs truncate"
                                            title="{{ $address->street_address_1 }}">
                                            {{ $address->street_address_1 }}
                                        </div>
                                        @if ($address->street_address_2)
                                            <div class="text-sm text-gray-500 max-w-xs truncate"
                                                title="{{ $address->street_address_2 }}">
                                                {{ $address->street_address_2 }}
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex space-x-2">
                                            <button class="text-blue-600 hover:text-blue-900 transition duration-150"
                                                title="View Details">
                                                <i class="fas fa-eye"></i>
                                            </button>
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
                {{-- <div class="bg-white px-6 py-4 border-t border-gray-200">
                    <div class="flex flex-col sm:flex-row justify-between items-center space-y-4 sm:space-y-0">
                        <div class="text-sm text-gray-700">
                            Showing <span class="font-medium">{{ $addresses->firstItem() ?? 0 }}</span> to
                            <span class="font-medium">{{ $addresses->lastItem() ?? 0 }}</span> of
                            <span class="font-medium">{{ $addresses->total() }}</span> results
                        </div>
                        <div class="flex space-x-2">
                            @if ($addresses->onFirstPage())
                                <span class="px-3 py-1 rounded-lg bg-gray-100 text-gray-400 cursor-not-allowed">
                                    <i class="fas fa-chevron-left"></i>
                                </span>
                            @else
                                <a href="{{ $addresses->previousPageUrl() }}"
                                    class="px-3 py-1 rounded-lg bg-blue-600 text-white hover:bg-blue-700 transition duration-150">
                                    <i class="fas fa-chevron-left"></i>
                                </a>
                            @endif

                            @foreach (range(1, min(5, $addresses->lastPage())) as $page)
                                <a href="{{ $addresses->url($page) }}"
                                    class="px-3 py-1 rounded-lg {{ $addresses->currentPage() === $page ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }} transition duration-150">
                                    {{ $page }}
                                </a>
                            @endforeach

                            @if ($addresses->hasMorePages())
                                <a href="{{ $addresses->nextPageUrl() }}"
                                    class="px-3 py-1 rounded-lg bg-blue-600 text-white hover:bg-blue-700 transition duration-150">
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                            @else
                                <span class="px-3 py-1 rounded-lg bg-gray-100 text-gray-400 cursor-not-allowed">
                                    <i class="fas fa-chevron-right"></i>
                                </span>
                            @endif
                        </div>
                    </div>
                </div> --}}
            </div>
        @else
            <!-- Empty State -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-12 text-center">
                <div class="max-w-md mx-auto">
                    <div class="w-24 h-24 mx-auto mb-6 bg-gray-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-map-marker-alt text-gray-400 text-3xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">No Addresses Found</h3>
                    <p class="text-gray-600 mb-6">There are no addresses in the system yet. Start by adding the first
                        address.</p>
                    <button
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg transition duration-200 inline-flex items-center">
                        <i class="fas fa-plus mr-2"></i>
                        Add First Address
                    </button>
                </div>
            </div>
        @endif
    </div>

    <style>
        .table-row:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }
    </style>
</x-layouts.admin>
