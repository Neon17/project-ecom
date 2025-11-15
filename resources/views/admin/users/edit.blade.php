<x-layouts.admin>


    <div class="px-3 mb-3 submit-wrapper">
        <a type="submit" href="{{ route('admin.users.index') }}"
            class="p-3 text-blue-500 hover:text-blue-700 transition-all duration-300 hover:cursor-pointer">Back to
            Table</a>
    </div>

    <div class="heading-wrapper text-2xl p-3 ms-2">
        Edit User
    </div>

    <form action="{{ route('users.update', $user->id) }}" method="POST" class="max-w-3xl">
        @csrf
        @method('PUT')

        <div class="m-3 px-3 submit-wrapper flex justify-end">
            <button type="submit"
                class="p-3 bg-blue-500 text-white hover:bg-blue-700 transition-all duration-300 hover:cursor-pointer">Update</button>
        </div>

        <div class="main-table bg-gray-50 my-3">
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

        <div class="text-xl mx-2 mt-10 mb-3">
            Addresses (optional)
        </div>

        @foreach ($user->addresses as $address)
            <div class="add-address-item-input bg-gray-50 py-3">
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
        @endforeach


        <div class="add-address-item-input bg-gray-50 py-3">
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
                <button
                    class="p-3 bg-blue-500 text-white hover:bg-blue-700 transition-all duration-300 hover:cursor-pointer">
                    Add Address
                </button>
            </div>
        </div>

    </form>



</x-layouts.admin>
