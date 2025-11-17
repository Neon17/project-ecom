<x-layouts.admin>
    <!-- Back Button -->
    <div class="mb-4">
        <a href="{{ route('admin.orders.index') }}" 
           class="inline-block px-4 py-2 text-blue-600 hover:text-blue-800 transition duration-300">
            ← Back to Orders
        </a>
    </div>

    <!-- Page Heading -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Edit Order</h1>
    </div>

    <!-- Main Form -->
    <form action="#" method="post" class="max-w-2xl">
        @csrf

        <!-- Order Details -->
        <div class="bg-white rounded-lg shadow-sm border p-6 mb-6">
            <h2 class="text-lg font-semibold mb-4">Order Information</h2>
            
            <!-- User Field -->
            <div class="mb-4">
                <label for="user" class="block text-sm font-medium text-gray-700 mb-1">User</label>
                <input type="text" name="user" id="user" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Address Field -->
            <div class="mb-4">
                <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                <textarea name="address" id="address" rows="3" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
            </div>

            <!-- Status Field -->
            <div class="mb-4">
                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select name="status" id="status" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Select Status</option>
                    <option value="pending">Pending</option>
                    <option value="processed">Processed</option>
                    <option value="completed">Completed</option>
                    <option value="cancelled">Cancelled</option>
                </select>
            </div>
        </div>

        <!-- Order Items -->
        <div class="bg-white rounded-lg shadow-sm border p-6 mb-6">
            <h2 class="text-lg font-semibold mb-4">Order Items</h2>
            
            <!-- Product Selection -->
            <div class="mb-4">
                <label for="product_id" class="block text-sm font-medium text-gray-700 mb-1">Product</label>
                <select name="product_id" id="product_id" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Select Product</option>
                    <option value="1">Laptop</option>
                    <option value="2">Mobile</option>
                </select>
            </div>

            <!-- Quantity -->
            <div class="mb-4">
                <label for="quantity" class="block text-sm font-medium text-gray-700 mb-1">Quantity</label>
                <input type="number" name="quantity" id="quantity" min="1" max="100" 
                       class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Price -->
            <div class="mb-4">
                <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Price per Item (in paisa)</label>
                <input type="number" name="price" id="price" min="100" value="100" 
                       class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex items-center gap-3">
            <!-- Add Item Button -->
            <button type="button" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition duration-300">
                + Add Item
            </button>
            
            <!-- Update Button -->
            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition duration-300">
                Update Order
            </button>
        </div>
    </form>
</x-layouts.admin>