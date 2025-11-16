<x-layouts.admin>


    <div class="px-3 mb-3 submit-wrapper">
        <a type="submit" href="{{ route('admin.users.index') }}"
            class="p-3 text-blue-500 hover:text-blue-700 transition-all duration-300 hover:cursor-pointer">Back to
            Table</a>
    </div>

    <div class="heading-wrapper text-2xl p-3 ms-2">
        Edit User
    </div>

    <form action="{{ route('users.update', $user->id) }}" method="POST" class="max-w-7xl">
        @csrf
        @method('PUT')

        <div class="m-3 px-3 submit-wrapper flex justify-end">
            <button type="submit"
                class="p-3 bg-blue-500 text-white hover:bg-blue-700 transition-all duration-300 hover:cursor-pointer">Update
                User</button>
        </div>

        <div class="main-table my-3">
            <div class="m-3 p-3 flex flex-col">
                <label for="name">Name:*</label>
                <input type="text" name="name" id="name" value="{{ $user->name }}" class="border p-2">
            </div>

            <div class="m-3 p-3 flex flex-col">
                <label for="email">Email:*</label>
                <input type="text" name="email" id="email" value="{{ $user->email }}" class="border p-2">
            </div>

            <div class="m-3 p-3 flex flex-col">
                <label for="password">New Password:</label>
                <input type="text" name="password" id="password" class="border p-2">
            </div>

            <div class="m-3 p-3 flex flex-col">
                <label for="password_confirmation">Confirm New Password:</label>
                <input type="text" name="password_confirmation" id="password_confirmation" class="border p-2">
            </div>

            <div class="m-3 p-3 flex flex-col">
                <select name="role" id="role" class="p-2 border">
                    <option value="">Select Role*</option>
                    @foreach (enum_labels(\App\Enums\RoleEnum::class) as $value => $label)
                        <option value="{{ $value }}" {{ $value == $user->role->value ? 'selected' : '' }}>
                            {{ $label }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </form>

    @if ($user->addresses->count() > 0)

        <div class="max-w-7xl">

            <div class="m-3 px-3 submit-wrapper flex justify-start items-center">
                <div class="text-2xl mx-2 mt-10 mb-3 w-1/2 text-left">
                    User Addresses
                </div>
            </div>

            @foreach ($user->addresses as $address)
                <form action="{{ route('users.addresses.update', ['address' => $address->id, 'user' => $user]) }}"
                    method="POST">
                    @csrf
                    @method('PUT')
                    <div class="add-address-item-input py-3">
                        <div class="heading-button-wrapper flex items-center">
                            <div class="text-xl p-5 text-left w-1/2">
                                Address {{ $loop->iteration }}
                            </div>
                            <div class="flex justify-end w-1/2 gap-1 pe-6 items-center">

                                <button
                                    class="open-delete-modal hover:cursor-pointer p-3 bg-red-500 text-white mx-2 rounded hover:bg-red-700 duration-300 transaction-all">
                                        Delete Address
                                </button>
                                
                                <x-ui.delete-modal
                                    action="{{ route('users.addresses.destroy', ['address' => $address->id, 'user' => $user]) }}" />

                                <button type="submit"
                                    class="p-3 m-1 bg-blue-500 text-white hover:bg-blue-700 transition-all duration-300 hover:cursor-pointer">
                                    Update Address
                                </button>
                            </div>
                        </div>
                        <div class="order-item-form">
                            <div class="m-3 p-3 flex flex-col">
                                <label for="country">Country*</label>
                                <input type="text" name="country" id="country" value="{{ $address->country }}"
                                    class="border p-2">
                                @error('country')
                                    <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="m-3 p-3 flex flex-col">
                                <label for="city">City*</label>
                                <input type="text" name="city" id="city" value="{{ $address->city }}"
                                    class="border p-2">
                                @error('city')
                                    <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="m-3 p-3 flex flex-col">
                                <label for="state">State*</label>
                                <input type="text" name="state" id="state" value="{{ $address->state }}"
                                    class="border p-2">
                                @error('state')
                                    <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="m-3 p-3 flex flex-col">
                                <label for="street_address_1">Street Address 1*</label>
                                <input type="text" name="street_address_1" value="{{ $address->street_address_1 }}"
                                    id="street_address_1" class="border p-2">
                                @error('street_address_1')
                                    <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="m-3 p-3 flex flex-col">
                                <label for="street_address_2">Street Address 2</label>
                                <input type="text" name="street_address_2" value="{{ $address->street_address_2 }}"
                                    id="street_address_2" class="border p-2">
                                @error('street_address_2')
                                    <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                    </div>
                </form>
            @endforeach

        </div>
    @endif


    <form class="max-w-7xl" action="{{ route('users.addresses.store', $user->id) }}" method="POST">
        @csrf
        @method('POST')

        <div class="text-xl mx-2 mt-10 mb-3">
            Add Address
        </div>


        <div class="add-address-item-input py-3">
            <div class="order-item-form">
                <div class="m-3 p-3 flex flex-col">
                    <label for="country">Country*</label>
                    <input type="text" name="country" id="country" class="border p-2">
                </div>
                <div class="m-3 p-3 flex flex-col">
                    <label for="city">City*</label>
                    <input type="text" name="city" id="city" class="border p-2">
                </div>
                <div class="m-3 p-3 flex flex-col">
                    <label for="state">State*</label>
                    <input type="text" name="state" id="state" class="border p-2">
                </div>
                <div class="m-3 p-3 flex flex-col">
                    <label for="street_address_1">Street Address 1*</label>
                    <input type="text" name="street_address_1" id="street_address_1" class="border p-2">
                </div>
                <div class="m-3 p-3 flex flex-col">
                    <label for="street_address_2">Street Address 2</label>
                    <input type="text" name="street_address_2" id="street_address_2" class="border p-2">
                </div>
            </div>

        </div>

        <div class="flex items-center">

            <div class="add-order-items ps-5 pb-5 mt-5">
                <button type="submit"
                    class="p-3 bg-blue-500 text-white hover:bg-blue-700 transition-all duration-300 hover:cursor-pointer">
                    Add Address
                </button>
            </div>
        </div>

    </form>



</x-layouts.admin>
