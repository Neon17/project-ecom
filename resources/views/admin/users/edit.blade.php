<x-layouts.admin>


    <div class="px-3 mb-3 submit-wrapper">
        <a type="submit" href="{{ route('admin.users.index') }}"
            class="p-3 text-blue-500 hover:text-blue-700 transition-all duration-300 hover:cursor-pointer">Back to
            Table</a>
    </div>

    <div class="heading-wrapper text-2xl p-3 ms-2">
        Edit User
    </div>

    <form action="#" method="post" class="max-w-3xl">
        @csrf

        <div class="m-3 px-3 submit-wrapper flex justify-end">
            <button type="submit"
                class="p-3 bg-blue-500 text-white hover:bg-blue-700 transition-all duration-300 hover:cursor-pointer">Update</button>
        </div>

        <div class="main-table bg-gray-50 my-3">
            <div class="m-3 p-3 flex flex-col">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="border p-2">
            </div>

            <div class="m-3 p-3 flex flex-col">
                <label for="slug">Email:</label>
                <input type="text" name="slug" id="slug" class="border p-2">
            </div>

            <div class="m-3 p-3 flex flex-col">
                <label for="slug">Password:</label>
                <input type="text" name="slug" id="slug" class="border p-2">
            </div>

            <div class="m-3 p-3 flex flex-col">
                <label for="slug">Confirm Password:</label>
                <input type="text" name="slug" id="slug" class="border p-2">
            </div>

            <div class="m-3 p-3 flex flex-col">
                <label for="slug">Role:</label>
                <input type="text" name="slug" id="slug" class="border p-2">
            </div>
        </div>


        {{-- Order Items --}}



        <div class="text-xl mx-2 mt-10 mb-3">
            Addresses
        </div>

        <div class="add-address-item-input bg-gray-50 py-3">
            <div class="order-item-form">
                <div class="m-3 p-3 flex flex-col">
                    <label for="slug">Country:</label>
                    <input type="text" name="slug" id="slug" class="border p-2">
                </div>
                <div class="m-3 p-3 flex flex-col">
                    <label for="slug">City:</label>
                    <input type="text" name="slug" id="slug" class="border p-2">
                </div>
                <div class="m-3 p-3 flex flex-col">
                    <label for="slug">State</label>
                    <input type="text" name="slug" id="slug" class="border p-2">
                </div>
                <div class="m-3 p-3 flex flex-col">
                    <label for="slug">Street Address 1</label>
                    <input type="text" name="slug" id="slug" class="border p-2">
                </div>
                <div class="m-3 p-3 flex flex-col">
                    <label for="slug">Street Address 2</label>
                    <input type="text" name="slug" id="slug" class="border p-2">
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
