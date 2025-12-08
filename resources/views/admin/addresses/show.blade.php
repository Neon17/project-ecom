<x-layouts.admin>
    <div class="mb-6">
        <a href="{{ route('admin.addresses.all') }}" class="text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white flex items-center">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Back to Addresses
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Address Details -->
        <div class="lg:col-span-2">
            <div class="bg-white dark:bg-slate-900 rounded-lg shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-700 flex items-center">
                    <i class="fas fa-map-marker-alt text-blue-600 dark:text-blue-400 text-xl mr-3"></i>
                    <h1 class="text-xl font-bold text-gray-800 dark:text-gray-200">Address Details</h1>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Country</label>
                            <p class="text-gray-900 dark:text-white font-medium">{{ $address->country }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">State/Province</label>
                            <p class="text-gray-900 dark:text-white font-medium">{{ $address->state ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">City</label>
                            <p class="text-gray-900 dark:text-white font-medium">{{ $address->city }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Created At</label>
                            <p class="text-gray-900 dark:text-white font-medium">{{ $address->created_at->format('M d, Y') }}</p>
                        </div>
                    </div>

                    <hr class="my-6 border-gray-200 dark:border-gray-700">

                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Street Address 1</label>
                            <p class="text-gray-900 dark:text-white">{{ $address->street_address_1 }}</p>
                        </div>
                        @if($address->street_address_2)
                        <div>
                            <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Street Address 2</label>
                            <p class="text-gray-900 dark:text-white">{{ $address->street_address_2 }}</p>
                        </div>
                        @endif
                    </div>

                    <!-- Map Embed (optional) -->
                    <div class="mt-6 rounded-lg overflow-hidden border border-gray-200 dark:border-gray-700">
                        <iframe 
                            src="https://www.google.com/maps?q={{ urlencode($address->city . ', ' . $address->state . ', ' . $address->country) }}&output=embed"
                            width="100%" 
                            height="250" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy"
                            class="grayscale dark:invert dark:contrast-75">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar - User Info -->
        <div>
            <div class="bg-white dark:bg-slate-900 rounded-lg shadow-sm border border-gray-100 dark:border-gray-700 p-6">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">
                    <i class="fas fa-user mr-2 text-blue-600 dark:text-blue-400"></i>User Information
                </h3>
                <div class="flex items-center mb-4">
                    <div class="w-14 h-14 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center">
                        <span class="text-blue-600 dark:text-blue-400 font-bold text-xl">{{ substr($address->user->name, 0, 1) }}</span>
                    </div>
                    <div class="ml-4">
                        <h4 class="font-semibold text-gray-900 dark:text-white">{{ $address->user->name }}</h4>
                        <a href="mailto:{{ $address->user->email }}" class="text-sm text-blue-600 dark:text-blue-400 hover:underline">
                            {{ $address->user->email }}
                        </a>
                    </div>
                </div>
                <hr class="my-4 border-gray-200 dark:border-gray-700">
                <dl class="space-y-3">
                    <div>
                        <dt class="text-sm text-gray-500 dark:text-gray-400">User ID</dt>
                        <dd class="text-sm font-medium text-gray-900 dark:text-white">#{{ $address->user_id }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm text-gray-500 dark:text-gray-400">Role</dt>
                        <dd>
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                {{ $address->user->role->value === 'admin' ? 'bg-purple-100 text-purple-800' : 'bg-gray-100 text-gray-800' }}">
                                {{ ucfirst($address->user->role->value) }}
                            </span>
                        </dd>
                    </div>
                    <div>
                        <dt class="text-sm text-gray-500 dark:text-gray-400">Total Addresses</dt>
                        <dd class="text-sm font-medium text-gray-900 dark:text-white">{{ $address->user->addresses->count() }}</dd>
                    </div>
                </dl>
                <a href="{{ route('admin.users.show', $address->user_id) }}" 
                   class="mt-4 block text-center w-full bg-gray-100 dark:bg-slate-700 hover:bg-gray-200 dark:hover:bg-slate-600 text-gray-800 dark:text-white py-2 rounded-lg font-medium transition-colors">
                    View User Profile
                </a>
            </div>
        </div>
    </div>
</x-layouts.admin>
