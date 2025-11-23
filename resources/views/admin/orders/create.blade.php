{{-- Clean Order Create Form --}}
<x-layouts.admin>
    <div class="w-full py-6 px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <a href="{{ route('admin.orders.index') }}" 
               class="inline-flex items-center text-blue-500 hover:text-blue-700 text-sm font-medium mb-4 transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back to Orders
            </a>
            <h1 class="text-2xl font-bold text-gray-900">Create New Order</h1>
            <p class="text-gray-500 mt-2">Add a new customer order</p>
        </div>

        <form action="{{ route('admin.orders.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Order Details -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Order Details</h2>
                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
                    <div>
                        <label for="user_id" class="block text-sm font-medium text-gray-700 mb-2">Customer *</label>
                        <select name="user_id" id="user_id" required
                                class="w-full border border-gray-200 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                            <option value="">Select customer</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status *</label>
                        <select name="status" id="status" required
                                class="w-full border border-gray-200 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                            <option value="">Select status</option>
                            <option value="pending">Pending</option>
                            <option value="processed">Processed</option>
                            <option value="completed">Completed</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                        @error('status')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Shipping Address -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Shipping Address</h2>
                
                <div class="space-y-5">
                    <div>
                        <label for="address_country" class="block text-sm font-medium text-gray-700 mb-2">Country *</label>
                        <input type="text" name="address[country]" id="address_country" required
                               class="w-full border border-gray-200 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                               placeholder="Country">
                        @error('address.country')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
                        <div>
                            <label for="address_state" class="block text-sm font-medium text-gray-700 mb-2">State *</label>
                            <input type="text" name="address[state]" id="address_state" required
                                   class="w-full border border-gray-200 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                                   placeholder="State">
                            @error('address.state')
                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="address_city" class="block text-sm font-medium text-gray-700 mb-2">City *</label>
                            <input type="text" name="address[city]" id="address_city" required
                                   class="w-full border border-gray-200 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                                   placeholder="City">
                            @error('address.city')
                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="address_street_address_1" class="block text-sm font-medium text-gray-700 mb-2">Street Address 1 *</label>
                        <input type="text" name="address[street_address_1]" id="address_street_address_1" required
                               class="w-full border border-gray-200 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                               placeholder="Primary address">
                        @error('address.street_address_1')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="address_street_address_2" class="block text-sm font-medium text-gray-700 mb-2">Street Address 2</label>
                        <input type="text" name="address[street_address_2]" id="address_street_address_2"
                               class="w-full border border-gray-200 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                               placeholder="Additional address">
                        @error('address.street_address_2')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Order Items -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold text-gray-800">Order Items</h2>
                    <button type="button" id="add-product-btn"
                            class="inline-flex items-center px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 text-sm font-medium transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Add Product
                    </button>
                </div>

                <div id="products-container" class="space-y-4">
                    <div class="text-center py-8 text-gray-400 text-sm bg-gray-50 rounded-lg" id="no-products-message">
                        No products added yet
                    </div>
                </div>

                <template id="product-template">
                    <div class="product-row border border-gray-200 rounded-lg p-5 bg-gray-50">
                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 mb-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Product *</label>
                                <select name="products[][id]" required
                                        class="product-select w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                                    <option value="">Select Product</option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}" data-price="{{ $product->price }}">
                                            {{ $product->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Quantity *</label>
                                <input type="number" name="products[][quantity]" required min="1" value="1"
                                       class="quantity-input w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Price (NPR) *</label>
                                <input type="number" name="products[][amount_per_item]" required min="0" step="0.01"
                                       class="price-input w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                                       placeholder="0.00">
                            </div>
                        </div>

                        <div class="flex justify-end">
                            <button type="button"
                                    class="remove-product-btn inline-flex items-center px-3 py-2 bg-red-500 text-white text-sm rounded-lg hover:bg-red-600 transition-colors">
                                Remove
                            </button>
                        </div>
                    </div>
                </template>
            </div>

            <div class="flex justify-end pt-4">
                <button type="submit"
                        class="px-6 py-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600 font-medium transition-colors">
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