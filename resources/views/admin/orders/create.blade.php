{{-- Clean Order Create Form --}}
<x-layouts.admin>
    <div class="max-w-4xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-6">
            <a href="{{ route('admin.orders.index') }}" 
               class="inline-flex items-center text-blue-600 hover:text-blue-800 text-sm font-medium mb-4">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back to Orders
            </a>
            <h1 class="text-2xl font-bold text-gray-900">Create New Order</h1>
            <p class="text-gray-600 mt-1">Add a new customer order</p>
        </div>

        <form action="{{ route('admin.orders.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Order Details -->
            <div class="bg-white rounded-lg border border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Order Details</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="user_id" class="block text-sm font-medium text-gray-700 mb-1">Customer *</label>
                        <select name="user_id" id="user_id" required
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500">
                            <option value="">Select customer</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status *</label>
                        <select name="status" id="status" required
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500">
                            <option value="">Select status</option>
                            <option value="pending">Pending</option>
                            <option value="processed">Processed</option>
                            <option value="completed">Completed</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                        @error('status')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Shipping Address -->
            <div class="bg-white rounded-lg border border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Shipping Address</h2>
                
                <div class="space-y-4">
                    <div>
                        <label for="address_country" class="block text-sm font-medium text-gray-700 mb-1">Country *</label>
                        <input type="text" name="address[country]" id="address_country" required
                               class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500"
                               placeholder="Country">
                        @error('address.country')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="address_state" class="block text-sm font-medium text-gray-700 mb-1">State *</label>
                            <input type="text" name="address[state]" id="address_state" required
                                   class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500"
                                   placeholder="State">
                            @error('address.state')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="address_city" class="block text-sm font-medium text-gray-700 mb-1">City *</label>
                            <input type="text" name="address[city]" id="address_city" required
                                   class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500"
                                   placeholder="City">
                            @error('address.city')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="address_street_address_1" class="block text-sm font-medium text-gray-700 mb-1">Street Address 1 *</label>
                        <input type="text" name="address[street_address_1]" id="address_street_address_1" required
                               class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500"
                               placeholder="Primary address">
                        @error('address.street_address_1')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="address_street_address_2" class="block text-sm font-medium text-gray-700 mb-1">Street Address 2</label>
                        <input type="text" name="address[street_address_2]" id="address_street_address_2"
                               class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500"
                               placeholder="Additional address">
                        @error('address.street_address_2')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Order Items -->
            <div class="bg-white rounded-lg border border-gray-200 p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold text-gray-800">Order Items</h2>
                    <button type="button" id="add-product-btn"
                            class="inline-flex items-center px-3 py-1 bg-green-600 text-white rounded-md hover:bg-green-700 text-sm">
                        Add Product
                    </button>
                </div>

                <div id="products-container" class="space-y-4">
                    <div class="text-center py-8 text-gray-500 text-sm bg-gray-50 rounded-md" id="no-products-message">
                        No products added yet
                    </div>
                </div>

                <template id="product-template">
                    <div class="product-row border border-gray-200 rounded-md p-4 bg-gray-50">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-3 mb-3">
                            <div>
                                <label class="block text-xs font-medium text-gray-700 mb-1">Product *</label>
                                <select name="products[][id]" required
                                        class="product-select w-full border border-gray-300 rounded-md px-2 py-1 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500">
                                    <option value="">Select Product</option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}" data-price="{{ $product->price }}">
                                            {{ $product->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="block text-xs font-medium text-gray-700 mb-1">Quantity *</label>
                                <input type="number" name="products[][quantity]" required min="1" value="1"
                                       class="quantity-input w-full border border-gray-300 rounded-md px-2 py-1 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500">
                            </div>

                            <div>
                                <label class="block text-xs font-medium text-gray-700 mb-1">Price (NPR) *</label>
                                <input type="number" name="products[][amount_per_item]" required min="0" step="0.01"
                                       class="price-input w-full border border-gray-300 rounded-md px-2 py-1 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500"
                                       placeholder="0.00">
                            </div>
                        </div>

                        <div class="flex justify-end">
                            <button type="button"
                                    class="remove-product-btn inline-flex items-center px-2 py-1 bg-red-500 text-white text-xs rounded hover:bg-red-600">
                                Remove
                            </button>
                        </div>
                    </div>
                </template>
            </div>

            <div class="flex justify-end pt-2">
                <button type="submit"
                        class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 font-medium">
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

            addProductBtn.addEventListener('click', function() {
                if (noProductsMessage) {
                    noProductsMessage.style.display = 'none';
                }

                const productRow = productTemplate.content.cloneNode(true);
                const productSelect = productRow.querySelector('.product-select');
                const priceInput = productRow.querySelector('.price-input');
                const removeBtn = productRow.querySelector('.remove-product-btn');

                const inputs = productRow.querySelectorAll('input, select');
                inputs.forEach(input => {
                    const name = input.getAttribute('name');
                    if (name) {
                        input.setAttribute('name', name.replace('[]', `[${productCount}]`));
                    }
                });

                productSelect.addEventListener('change', function() {
                    const selectedOption = this.options[this.selectedIndex];
                    const price = selectedOption.getAttribute('data-price');
                    if (price) {
                        priceInput.value = (price / 100).toFixed(2);
                    }
                });

                removeBtn.addEventListener('click', function() {
                    productsContainer.removeChild(this.closest('.product-row'));
                    if (productsContainer.children.length === 1) {
                        noProductsMessage.style.display = 'block';
                    }
                });

                productsContainer.appendChild(productRow);
                productCount++;
            });

            const form = document.querySelector('form');
            form.addEventListener('submit', function(e) {
                const productRows = document.querySelectorAll('.product-row');
                if (productRows.length === 0) {
                    e.preventDefault();
                    alert('Please add at least one product to the order.');
                    return;
                }

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