<x-layouts.admin>

    <div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8 bg-gray-100 dark:bg-slate-800 min-h-screen rounded-lg shadow-md mt-8">
        <!-- Header -->
        <div class="bg-white dark:bg-slate-900 rounded-lg shadow-md p-6 mb-8 flex justify-between items-center">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">User Details #{{ $user->id }}</h1>
            <a href="{{ route('admin.users.index') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-slate-700 text-gray-700 dark:text-gray-300 dark:text-gray-600 rounded-md hover:bg-gray-300 transition-colors duration-200 font-medium">
                Back to Users List
            </a>
        </div>

        <!-- User Information Card -->
        <div class="bg-white dark:bg-slate-900 rounded-lg shadow-md border border-gray-200 dark:border-slate-700 p-8 mb-8">
            <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-6 pb-4 border-b border-gray-200 dark:border-slate-700">User Information</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Full Name -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 dark:text-gray-600 mb-2">Full Name</label>
                    <p class="w-full px-4 py-3 bg-gray-50 dark:bg-slate-800 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-800 dark:text-gray-200 font-medium cursor-not-allowed">
                        {{ $user->name }}
                    </p>
                </div>

                <!-- Email Address -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 dark:text-gray-600 mb-2">Email Address</label>
                    <p class="w-full px-4 py-3 bg-gray-50 dark:bg-slate-800 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-800 dark:text-gray-200 font-medium cursor-not-allowed">
                        {{ $user->email }}
                    </p>
                </div>

                <!-- User Role -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 dark:text-gray-600 mb-2">User Role</label>
                    <p class="w-full px-4 py-3 bg-gray-50 dark:bg-slate-800 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-800 dark:text-gray-200 font-medium capitalize cursor-not-allowed">
                        {{ $user->role }}
                    </p>
                </div>
            </div>
        </div>

        <!-- User Addresses Section -->
        <div class="bg-white dark:bg-slate-900 rounded-lg shadow-md border border-gray-200 dark:border-slate-700 p-8">
            <div class="flex justify-between items-center mb-6 pb-4 border-b border-gray-200 dark:border-slate-700">
                <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200">User Addresses</h2>
                <span class="px-4 py-2 bg-blue-100 text-blue-800 text-sm font-medium rounded-full">
                    {{ $user->addresses->count() }} addresses
                </span>
            </div>

            @if($user->addresses->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full leading-normal">
                        <thead>
                            <tr class="bg-gray-100 dark:bg-slate-800 border-b border-gray-200 dark:border-slate-700">
                                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 dark:text-gray-600 uppercase tracking-wider">SN</th>
                                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 dark:text-gray-600 uppercase tracking-wider">Country</th>
                                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 dark:text-gray-600 uppercase tracking-wider">City</th>
                                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 dark:text-gray-600 uppercase tracking-wider">State</th>
                                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 dark:text-gray-600 uppercase tracking-wider">Street Address 1</th>
                                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 dark:text-gray-600 uppercase tracking-wider">Street Address 2</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-slate-900 divide-y divide-gray-200">
                            @foreach($user->addresses as $address)
                            <tr class="hover:bg-gray-50 dark:hover:bg-slate-700 dark:bg-slate-800 transition-colors duration-150">
                                <td class="px-5 py-5 text-sm text-gray-800 dark:text-gray-200">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="px-5 py-5 text-sm text-gray-800 dark:text-gray-200">
                                    {{ $address->country ?? 'N/A' }}
                                </td>
                                <td class="px-5 py-5 text-sm text-gray-800 dark:text-gray-200">
                                    {{ $address->city ?? 'N/A' }}
                                </td>
                                <td class="px-5 py-5 text-sm text-gray-800 dark:text-gray-200">
                                    {{ $address->state ?? 'N/A' }}
                                </td>
                                <td class="px-5 py-5 text-sm text-gray-800 dark:text-gray-200">
                                    {{ $address->street_address_1 ?? 'N/A' }}
                                </td>
                                <td class="px-5 py-5 text-sm text-gray-800 dark:text-gray-200">
                                    {{ $address->street_address_2 ?? 'N/A' }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-12 bg-gray-50 dark:bg-slate-800 rounded-lg">
                    <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-gray-100 dark:bg-slate-800">
                        <svg class="w-8 h-8 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <h3 class="mt-4 text-lg font-medium text-gray-900 dark:text-white">No addresses found</h3>
                    <p class="mt-2 text-gray-500 dark:text-gray-400 dark:text-gray-500">This user doesn't have any saved addresses yet.</p>
                </div>
            @endif
        </div>
    </div>
</x-layouts.admin>