<x-layouts.admin>


    <div class="px-3 mb-3 submit-wrapper">
        <a type="submit" href="{{ route('admin.orders.index') }}"
            class="p-3 text-blue-500 hover:text-blue-700 transition-all duration-300 hover:cursor-pointer">Back to
            Table</a>
    </div>

    <div class="heading-wrapper text-2xl p-3 ms-2">
        Create Order
    </div>

    <form action="#" method="post" class="max-w-3xl">
        @csrf

        <div class="main-table bg-gray-50 my-3">
            <div class="m-3 p-3 flex flex-col">
                <label for="name">User</label>
                <input type="text" name="name" id="name" class="border p-2">
            </div>

            <div class="m-3 p-3 flex flex-col">
                <label for="slug">Address:</label>
                <input type="text" name="slug" id="slug" class="border p-2">
            </div>

            <div class="m-3 p-3 flex flex-col">
                <label for="slug">Status:</label>
                <input type="text" name="slug" id="slug" class="border p-2">
            </div>
        </div>


        {{-- Order Items --}}

        <div class="order-items-subform bg-gray-50 py-3">
            <div class="sub-heading-wrapper text-xl p-3 ms-2">
                Order Items
            </div>

            <div class="order-item-form">
                <div class="m-3 p-3 flex flex-col">
                    <label for="slug">Product:</label>
                    <input type="text" name="slug" id="slug" class="border p-2">
                </div>
                <div class="m-3 p-3 flex flex-col">
                    <label for="slug">Quantity:</label>
                    <input type="text" name="slug" id="slug" class="border p-2">
                </div>
                <div class="m-3 p-3 flex flex-col">
                    <label for="slug">Amount</label>
                    <input type="text" name="slug" id="slug" class="border p-2">
                </div>
            </div>

        </div>

        <div class="flex items-center">

            <div class="add-order-items ps-5 pb-5 mt-5">
                <button
                    class="p-3 bg-blue-500 text-white hover:bg-blue-700 transition-all duration-300 hover:cursor-pointer">Add
                    Order Item</button>
            </div>

            <div class="m-3 px-3 submit-wrapper">
                <button type="submit"
                    class="p-3 bg-blue-500 text-white hover:bg-blue-700 transition-all duration-300 hover:cursor-pointer">Create</button>
            </div>
        </div>

    </form>



</x-layouts.admin>
