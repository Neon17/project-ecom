<x-layouts.admin>
    <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6 mb-8">
        <!-- Header Section -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8">
            <div class="mb-4 sm:mb-0">
                <h1 class="text-3xl font-bold text-gray-900">Address Management</h1>
                <p class="text-gray-600 mt-2">Manage and view all customer addresses</p>
            </div>
            <div class="flex space-x-3">
                <button
                    class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition duration-200 flex items-center">
                    <i class="fas fa-plus mr-2"></i>
                    Add Address
                </button>
            </div>
        </div>

        @if (!$addresses->isEmpty())
            <!-- Table Section -->
            <div class="overflow-x-auto rounded-lg border border-gray-200">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                SN
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                User
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Country
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                City
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                State
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Street Address
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($addresses as $address)
                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                <td class="px-4 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ ($addresses->currentPage() - 1) * $addresses->perPage() + $loop->iteration }}
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div
                                            class="flex-shrink-0 h-8 w-8 bg-blue-100 rounded-full flex items-center justify-center">
                                            <span
                                                class="text-blue-600 font-semibold text-sm">{{ substr($address->user->name, 0, 1) }}</span>
                                        </div>
                                        <div class="ml-3">
                                            <div class="text-sm font-medium text-gray-900">{{ $address->user->name }}
                                            </div>
                                            <div class="text-xs text-gray-500">{{ $address->user->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $address->country }}
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $address->city }}
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $address->state ?? 'N/A' }}
                                </td>
                                <td class="px-4 py-4">
                                    <div class="text-sm text-gray-900 max-w-[150px] truncate"
                                        title="{{ $address->street_address_1 }}">
                                        {{ \Illuminate\Support\Str::words($address->street_address_1, 3, '...') }}
                                    </div>
                                    @if ($address->street_address_2)
                                        <div class="text-xs text-gray-500 max-w-[150px] truncate"
                                            title="{{ $address->street_address_2 }}">
                                            {{ \Illuminate\Support\Str::words($address->street_address_2, 2, '...') }}
                                        </div>
                                    @endif
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap text-sm font-medium">
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
            <div class="mt-6">
                {{ $addresses->links() }}
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
</x-layouts.admin>
