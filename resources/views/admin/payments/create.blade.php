<x-layouts.admin>


    <div class="px-3 mb-3 submit-wrapper">
        <a type="submit" href="{{ route('admin.payments.index') }}"
            class="p-3 text-blue-500 hover:text-blue-700 transition-all duration-300 hover:cursor-pointer">Back to
            Table</a>
    </div>

    <div class="heading-wrapper text-2xl p-3 ms-2">
        Add Payment
    </div>

    <form action="#" method="post" class="max-w-3xl">
        @csrf

        <div class="m-3 p-3 flex flex-col">
            <label for="user_id">User:</label>
            <select name="user_id" class="border p-2" id="user_id">
                <option value="">Select User</option>
                <option value="1">User 1 (9812345678)</option>
                <option value="2">User 2 (9812345338)</option>
            </select>
        </div>

        <div class="m-3 p-3 flex flex-col">
            <label for="user_id">Payment Status:</label>
            <select name="user_id" class="border p-2" id="user_id">
                <option value="1">Paid</option>
                <option value="2" selected>Pending</option>
            </select>
        </div>

        <div class="m-3 p-3 flex flex-col">
            <label for="payment_method">Payment Method:</label>
            <select name="payment_method" class="border p-2" id="payment_method">
                <option value="">Select Payment Method</option>
                <option value="1">Cash</option>
                <option value="2">Esewa</option>
                <option value="3">Khalti</option>
            </select>
        </div>

        <div class="m-3 p-3 flex flex-col">
            <label for="order_id">Order:</label>
            <select name="order_id" class="border p-2" id="order_id">
                <option value="">Select Order</option>
                <option value="1">Order 1</option>
                <option value="2">Order 2</option>
            </select>
        </div>


        <div class="mx-3 px-3 submit-wrapper">
            <button type="submit"
                class="p-3 bg-blue-500 text-white hover:bg-blue-700 transition-all duration-300 hover:cursor-pointer">Add</button>
        </div>
    </form>



</x-layouts.admin>
