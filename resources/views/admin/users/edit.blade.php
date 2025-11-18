<x-layouts.admin>


    <div class="px-3 mb-3 submit-wrapper">
        <a type="submit" href="{{ route('admin.users.index') }}"
            class="p-3 text-blue-500 hover:text-blue-700 transition-all duration-300 hover:cursor-pointer">Back to
            Table</a>
    </div>


    <form id="user-form" action="{{ route('users.update', $user->id) }}" method="POST"
        class="bg-white rounded-lg shadow-sm p-6 mb-8">
        @csrf
        @method('PUT')
        <div class="flex justify-between w-full">
            <div class="heading-wrapper text-2xl p-3 ms-2">
                Edit User
            </div>

            <button type="submit"
                class="px-3 bg-blue-500 text-white font-medium rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">
                Update User
            </button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                    placeholder="Enter full name">
                @error('name')
                    <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                    placeholder="Enter email address">
                @error('email')
                    <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input type="password" name="password" id="password"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                    placeholder="Leave blank to keep current">
                @error('password')
                    <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm
                    Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                    placeholder="Confirm new password">
            </div>

            <div class="md:col-span-2">
                <label for="role" class="block text-sm font-medium text-gray-700 mb-1">User Role</label>
                <select name="role" id="role"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                    <option value="">Select a role</option>
                    @foreach (enum_labels(\App\Enums\RoleEnum::class) as $value => $label)
                        <option value="{{ $value }}" {{ old('role', $user->role->value) == $value ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
                @error('role')
                    <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </form>


    <div class="bg-white rounded-lg shadow-sm p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-6">Add New Address</h2>

        <form action="{{ route('users.addresses.store', $user->id) }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="new_country" class="block text-sm font-medium text-gray-700 mb-1">Country*</label>
                    <input type="text" name="country" id="new_country"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <label for="new_city" class="block text-sm font-medium text-gray-700 mb-1">City*</label>
                    <input type="text" name="city" id="new_city"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <label for="new_state" class="block text-sm font-medium text-gray-700 mb-1">State*</label>
                    <input type="text" name="state" id="new_state"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div class="md:col-span-2">
                    <label for="new_street_address_1" class="block text-sm font-medium text-gray-700 mb-1">Street
                        Address 1*</label>
                    <input type="text" name="street_address_1" id="new_street_address_1"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div class="md:col-span-2">
                    <label for="new_street_address_2" class="block text-sm font-medium text-gray-700 mb-1">Street
                        Address 2</label>
                    <input type="text" name="street_address_2" id="new_street_address_2"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                </div>
            </div>

            <div class="mt-6">
                <button type="submit"
                    class="px-6 py-3 bg-green-500 text-white font-medium rounded-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-colors">
                    Add Address
                </button>
            </div>
        </form>
    </div>


    @if ($user->addresses->count() > 0)
        <div class="mx-auto bg-white rounded-lg shadow-sm p-6 mb-8 my-3">

            <h2 class="text-xl font-semibold text-gray-800 mb-6">User Addresses</h2>

            <div class="space-y-6 flex gap-2 flex-wrap w-full">
                @foreach ($user->addresses as $address)
                    <div class="border border-gray-200 rounded-lg p-4">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-medium text-gray-700">Address {{ $loop->iteration }}</h3>
                            <div class="flex gap-2">
                                <button
                                    class="open-delete-modal px-4 py-2 bg-red-500 text-white text-sm rounded hover:bg-red-600 transition-colors">
                                    Delete
                                </button>
                                <x-ui.delete-modal
                                    action="{{ route('users.addresses.destroy', ['address' => $address->id, 'user' => $user]) }}" />

                                <button type="submit" form="address-form-{{ $address->id }}"
                                    class="px-4 py-2 bg-blue-500 text-white text-sm rounded hover:bg-blue-600 transition-colors">
                                    Update
                                </button>
                            </div>
                        </div>

                        <form id="address-form-{{ $address->id }}"
                            action="{{ route('users.addresses.update', ['address' => $address->id, 'user' => $user]) }}"
                            method="POST">
                            @csrf
                            @method('PUT')

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="country-{{ $address->id }}"
                                        class="block text-sm font-medium text-gray-700 mb-1">Country*</label>
                                    <input type="text" name="country" id="country-{{ $address->id }}"
                                        value="{{ old('country', $address->country) }}"
                                        class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500">
                                    @error('country')
                                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div>
                                    <label for="city-{{ $address->id }}"
                                        class="block text-sm font-medium text-gray-700 mb-1">City*</label>
                                    <input type="text" name="city" id="city-{{ $address->id }}"
                                        value="{{ old('city', $address->city) }}"
                                        class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500">
                                    @error('city')
                                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div>
                                    <label for="state-{{ $address->id }}"
                                        class="block text-sm font-medium text-gray-700 mb-1">State*</label>
                                    <input type="text" name="state" id="state-{{ $address->id }}"
                                        value="{{ old('state', $address->state) }}"
                                        class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500">
                                    @error('state')
                                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="md:col-span-2">
                                    <label for="street_address_1-{{ $address->id }}"
                                        class="block text-sm font-medium text-gray-700 mb-1">Street Address
                                        1*</label>
                                    <input type="text" name="street_address_1"
                                        id="street_address_1-{{ $address->id }}"
                                        value="{{ old('street_address_1', $address->street_address_1) }}"
                                        class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500">
                                    @error('street_address_1')
                                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="md:col-span-2">
                                    <label for="street_address_2-{{ $address->id }}"
                                        class="block text-sm font-medium text-gray-700 mb-1">Street Address
                                        2</label>
                                    <input type="text" name="street_address_2"
                                        id="street_address_2-{{ $address->id }}"
                                        value="{{ old('street_address_2', $address->street_address_2) }}"
                                        class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500">
                                    @error('street_address_2')
                                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

</x-layouts.admin>
