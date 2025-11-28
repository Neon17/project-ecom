<x-layouts.admin>


    <div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8 bg-gray-100 dark:bg-slate-800 min-h-screen rounded-lg shadow-md mt-8">
        <!-- Header and Back Button -->
        <div class="bg-white dark:bg-slate-900 rounded-lg shadow-md p-6 mb-8 flex justify-between items-center">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Edit User #{{ $user->id }}</h1>
            <a href="{{ route('admin.users.index') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-slate-700 text-gray-700 dark:text-gray-300 dark:text-gray-600 rounded-md hover:bg-gray-300 transition-colors duration-200 font-medium">
                Back to Users List
            </a>
        </div>

        <!-- User Details Form -->
        <form id="user-form" action="{{ route('users.update', $user->id) }}" method="POST"
            class="bg-white dark:bg-slate-900 rounded-lg shadow-md border border-gray-200 dark:border-slate-700 p-8 space-y-6 mb-8">
            @csrf
            @method('PUT')
            <div class="flex justify-between items-center mb-6 pb-4 border-b border-gray-200 dark:border-slate-700">
                <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200">User Profile</h2>
                <button type="submit"
                    class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-colors duration-300 shadow-md">
                    Update User
                </button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Full Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 dark:text-gray-600 mb-2">Full Name <span class="text-red-500">*</span></label>
                    <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                        class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                        placeholder="Enter full name" required>
                    @error('name')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email Address -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 dark:text-gray-600 mb-2">Email Address <span class="text-red-500">*</span></label>
                    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                        class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                        placeholder="Enter email address" required>
                    @error('email')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 dark:text-gray-600 mb-2">Password</label>
                    <input type="password" name="password" id="password"
                        class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                        placeholder="Leave blank to keep current password">
                    @error('password')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300 dark:text-gray-600 mb-2">Confirm
                        Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                        class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                        placeholder="Confirm new password">
                    @error('password_confirmation')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- User Role -->
                <div class="md:col-span-2">
                    <label for="role" class="block text-sm font-medium text-gray-700 dark:text-gray-300 dark:text-gray-600 mb-2">User Role <span class="text-red-500">*</span></label>
                    <select name="role" id="role" required
                        class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 appearance-none bg-white dark:bg-slate-900 pr-8">
                        <option value="">Select a role</option>
                        @foreach (enum_labels(\App\Enums\RoleEnum::class) as $value => $label)
                            <option value="{{ $value }}" {{ old('role', $user->role->value) == $value ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                    @error('role')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </form>

        <!-- Add New Address Section -->
        <div class="bg-white dark:bg-slate-900 rounded-lg shadow-md border border-gray-200 dark:border-slate-700 p-8 mb-8">
            <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-6 pb-4 border-b border-gray-200 dark:border-slate-700">Add New Address</h2>

            <form action="{{ route('users.addresses.store', $user->id) }}" method="POST" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="new_country" class="block text-sm font-medium text-gray-700 dark:text-gray-300 dark:text-gray-600 mb-2">Country <span class="text-red-500">*</span></label>
                        <input type="text" name="country" id="new_country" value="{{ old('country') }}"
                            class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                            placeholder="Enter country" required>
                        @error('country')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="new_city" class="block text-sm font-medium text-gray-700 dark:text-gray-300 dark:text-gray-600 mb-2">City <span class="text-red-500">*</span></label>
                        <input type="text" name="city" id="new_city" value="{{ old('city') }}"
                            class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                            placeholder="Enter city" required>
                        @error('city')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="new_state" class="block text-sm font-medium text-gray-700 dark:text-gray-300 dark:text-gray-600 mb-2">State <span class="text-red-500">*</span></label>
                        <input type="text" name="state" id="new_state" value="{{ old('state') }}"
                            class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                            placeholder="Enter state" required>
                        @error('state')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="new_street_address_1" class="block text-sm font-medium text-gray-700 dark:text-gray-300 dark:text-gray-600 mb-2">Street
                            Address 1 <span class="text-red-500">*</span></label>
                        <input type="text" name="street_address_1" id="new_street_address_1" value="{{ old('street_address_1') }}"
                            class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                            placeholder="Enter primary street address" required>
                        @error('street_address_1')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="new_street_address_2" class="block text-sm font-medium text-gray-700 dark:text-gray-300 dark:text-gray-600 mb-2">Street
                            Address 2 (Optional)</label>
                        <input type="text" name="street_address_2" id="new_street_address_2" value="{{ old('street_address_2') }}"
                            class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                            placeholder="Enter additional address information">
                        @error('street_address_2')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-end pt-4">
                    <button type="submit"
                        class="px-8 py-3 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition-colors duration-300 shadow-md">
                        Add Address
                    </button>
                </div>
            </form>
        </div>

        @if ($user->addresses->count() > 0)
            <div class="bg-white dark:bg-slate-900 rounded-lg shadow-md border border-gray-200 dark:border-slate-700 p-8">

                <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-6 pb-4 border-b border-gray-200 dark:border-slate-700">User Addresses</h2>

                <div class="space-y-6">
                    @foreach ($user->addresses as $address)
                        <div class="border border-gray-300 dark:border-gray-600 rounded-lg p-6 bg-gray-50 dark:bg-slate-800 shadow-sm">
                            <div class="flex justify-between items-center mb-6 pb-4 border-b border-gray-200 dark:border-slate-700">
                                <h3 class="text-xl font-medium text-gray-800 dark:text-gray-200">Address #{{ $loop->iteration }}</h3>
                                <div class="flex space-x-3">
                                    <button
                                        class="open-delete-modal inline-flex items-center px-4 py-2 bg-red-600 text-white text-sm rounded-lg hover:bg-red-700 transition-colors duration-200 font-medium">
                                        Delete
                                    </button>
                                    <x-ui.delete-modal
                                        action="{{ route('users.addresses.destroy', ['address' => $address->id, 'user' => $user]) }}" />

                                    <button type="submit" form="address-form-{{ $address->id }}"
                                        class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm rounded-lg hover:bg-blue-700 transition-colors duration-200 font-medium">
                                        Update
                                    </button>
                                </div>
                            </div>

                            <form id="address-form-{{ $address->id }}"
                                action="{{ route('users.addresses.update', ['address' => $address->id, 'user' => $user]) }}"
                                method="POST" class="space-y-4">
                                @csrf
                                @method('PUT')

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label for="country-{{ $address->id }}"
                                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 dark:text-gray-600 mb-2">Country <span class="text-red-500">*</span></label>
                                        <input type="text" name="country" id="country-{{ $address->id }}"
                                            value="{{ old('country', $address->country) }}"
                                            class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200" required>
                                        @error('country')
                                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="city-{{ $address->id }}"
                                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 dark:text-gray-600 mb-2">City <span class="text-red-500">*</span></label>
                                        <input type="text" name="city" id="city-{{ $address->id }}"
                                            value="{{ old('city', $address->city) }}"
                                            class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200" required>
                                        @error('city')
                                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="state-{{ $address->id }}"
                                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 dark:text-gray-600 mb-2">State <span class="text-red-500">*</span></label>
                                        <input type="text" name="state" id="state-{{ $address->id }}"
                                            value="{{ old('state', $address->state) }}"
                                            class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200" required>
                                        @error('state')
                                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="md:col-span-2">
                                        <label for="street_address_1-{{ $address->id }}"
                                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 dark:text-gray-600 mb-2">Street Address
                                            1 <span class="text-red-500">*</span></label>
                                        <input type="text" name="street_address_1"
                                            id="street_address_1-{{ $address->id }}"
                                            value="{{ old('street_address_1', $address->street_address_1) }}"
                                            class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200" required>
                                        @error('street_address_1')
                                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="md:col-span-2">
                                        <label for="street_address_2-{{ $address->id }}"
                                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 dark:text-gray-600 mb-2">Street Address
                                            2 (Optional)</label>
                                        <input type="text" name="street_address_2"
                                            id="street_address_2-{{ $address->id }}"
                                            value="{{ old('street_address_2', $address->street_address_2) }}"
                                            class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                                            placeholder="Enter additional address information">
                                        @error('street_address_2')
                                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>

</x-layouts.admin>
