{{-- In this edit, we can edit payment method --}}

<x-layouts.admin>
    <div class="container mx-auto px-4 py-8 max-w-4xl">
        <!-- Back Button -->
        <div class="mb-6">
            <a href="{{ route('admin.orders.index') }}"
                class="inline-flex items-center px-4 py-2 text-blue-600 hover:text-blue-800 transition duration-300">
                > Back to Orders
            </a>
        </div>

        <!-- Page Heading -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Create New Order</h1>
            <p class="text-gray-600 mt-2">Create a new order for a customer</p>
        </div>

        <!-- Main Form -->
        <form action="{{ route('admin.orders.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Order Details Section -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-6 pb-2 border-b border-gray-100">Order Information
                </h2>

                <!-- User Selection -->
                <div class="mb-6">
                    <label for="user_id" class="block text-sm font-medium text-gray-700 mb-2">Customer *</label>
                    <select name="user_id" id="user_id" required
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200">
                        <option value="">Select a customer</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                        @endforeach
                    </select>
                    @error('user_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status Selection -->
                <div class="mb-6">
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Order Status *</label>
                    <select name="status" id="status" required
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200">
                        <option value="">Select order status</option>
                        <option value="pending">Pending</option>
                        <option value="processed">Processed</option>
                        <option value="completed">Completed</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                    @error('status')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Address Information -->
                <div class="space-y-4">
                    <h3 class="text-lg font-medium text-gray-800 mb-4">Shipping Address *</h3>

                    <!-- Country -->
                    <div>
                        <label for="address_country" class="block text-sm font-medium text-gray-700 mb-2">Country
                            *</label>
                        <input type="text" name="address[country]" id="address_country" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                            placeholder="Enter country">
                        @error('address.country')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- State and City -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="address_state" class="block text-sm font-medium text-gray-700 mb-2">State
                                *</label>
                            <input type="text" name="address[state]" id="address_state" required
                                class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                                placeholder="Enter state">
                            @error('address.state')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="address_city" class="block text-sm font-medium text-gray-700 mb-2">City
                                *</label>
                            <input type="text" name="address[city]" id="address_city" required
                                class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                                placeholder="Enter city">
                            @error('address.city')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Street Addresses -->
                    <div>
                        <label for="address_street_address_1"
                            class="block text-sm font-medium text-gray-700 mb-2">Street Address 1 *</label>
                        <input type="text" name="address[street_address_1]" id="address_street_address_1" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                            placeholder="Enter primary street address">
                        @error('address.street_address_1')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="address_street_address_2"
                            class="block text-sm font-medium text-gray-700 mb-2">Street Address 2 (Optional)</label>
                        <input type="text" name="address[street_address_2]" id="address_street_address_2"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                            placeholder="Enter additional address information">
                        @error('address.street_address_2')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Order Items Section -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <div class="flex justify-between items-center mb-6 pb-2 border-b border-gray-100">
                    <h2 class="text-xl font-semibold text-gray-800">Order Items</h2>
                    <button type="button" id="add-product-btn"
                        class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                            </path>
                        </svg>
                        Add Product
                    </button>
                </div>

                <!-- Products Container -->
                <div id="products-container" class="space-y-4">
                    <!-- Product rows will be added here dynamically -->
                    <div class="text-center py-8 text-gray-500" id="no-products-message">
                        No products added yet. Click "Add Product" to get started.
                    </div>
                </div>

                <!-- Product Template (Hidden) -->
                <template id="product-template">
                    <div class="product-row border border-gray-200 rounded-lg p-4 bg-gray-50">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                            <!-- Product Selection -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Product *</label>
                                <select name="products[][id]" required
                                    class="product-select w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200">
                                    <option value="">Select Product</option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}" data-price="{{ $product->price }}">
                                            {{ $product->name }} ({{ number_format($product->price / 100, 2) }} NPR)
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Quantity -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Quantity *</label>
                                <input type="number" name="products[][quantity]" required min="1"
                                    value="1"
                                    class="quantity-input w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200">
                            </div>

                            <!-- Price per Item -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Price per Item (NPR)
                                    *</label>
                                <input type="number" name="products[][amount_per_item]" required min="0"
                                    step="0.01"
                                    class="price-input w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                                    placeholder="0.00">
                            </div>
                        </div>

                        <!-- Remove Button -->
                        <div class="flex justify-end">
                            <button type="button"
                                class="remove-product-btn inline-flex items-center px-3 py-1 bg-red-600 text-white text-sm rounded-lg hover:bg-red-700 transition duration-200">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                    </path>
                                </svg>
                                Remove
                            </button>
                        </div>
                    </div>
                </template>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end">
                <button type="submit"
                    class="px-8 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200 font-medium text-lg">
                    Create Order
                </button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const productsContainer = document.getElementById('products-container');
            const productTemplate = document.getElementById('product-template');
            const addProductBtn = document.getElementById('add-product-btn');
            const noProductsMessage = document.getElementById('no-products-message');

            let productCount = 0;

            // Add product row
            addProductBtn.addEventListener('click', function() {
                if (noProductsMessage) {
                    noProductsMessage.style.display = 'none';
                }

                const productRow = productTemplate.content.cloneNode(true);
                const productSelect = productRow.querySelector('.product-select');
                const priceInput = productRow.querySelector('.price-input');
                const removeBtn = productRow.querySelector('.remove-product-btn');

                // Update names with index
                const inputs = productRow.querySelectorAll('input, select');
                inputs.forEach(input => {
                    const name = input.getAttribute('name');
                    if (name) {
                        input.setAttribute('name', name.replace('[]', `[${productCount}]`));
                    }
                });

                // Auto-fill price when product is selected
                productSelect.addEventListener('change', function() {
                    const selectedOption = this.options[this.selectedIndex];
                    const price = selectedOption.getAttribute('data-price');
                    if (price) {
                        priceInput.value = (price / 100).toFixed(2);
                    }
                });

                // Remove product row
                removeBtn.addEventListener('click', function() {
                    productsContainer.removeChild(this.closest('.product-row'));
                    if (productsContainer.children.length === 1) { // Only no-products-message left
                        noProductsMessage.style.display = 'block';
                    }
                });

                productsContainer.appendChild(productRow);
                productCount++;
            });

            // Form validation
            const form = document.querySelector('form');
            form.addEventListener('submit', function(e) {
                const productRows = document.querySelectorAll('.product-row');
                if (productRows.length === 0) {
                    e.preventDefault();
                    alert('Please add at least one product to the order.');
                    return;
                }

                // Validate each product row
                let isValid = true;
                productRows.forEach(row => {
                    const productSelect = row.querySelector('.product-select');
                    const quantityInput = row.querySelector('.quantity-input');
                    const priceInput = row.querySelector('.price-input');

                    if (!productSelect.value || !quantityInput.value || !priceInput.value) {
                        isValid = false;
                    }
                });

                if (!isValid) {
                    e.preventDefault();
                    alert('Please fill in all required fields for each product.');
                }
            });
        });
    </script>
</x-layouts.admin>
