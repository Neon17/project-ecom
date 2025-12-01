<x-layouts.user>

    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-8 text-gray-800 dark:text-gray-200">Checkout</h1>

        <div class="flex flex-col lg:flex-row gap-8">

            <!-- Shipping Address Form -->
            <div class="lg:w-2/3">
                <div class="bg-white dark:bg-slate-900 rounded-lg shadow-md p-6">

                    <h2 class="text-xl font-semibold mb-6 text-gray-700 dark:text-gray-300 flex items-center">
                        <i class="fas fa-map-marker-alt mr-2 text-blue-600 dark:text-blue-400"></i>
                        Shipping Address
                    </h2>

                    <!-- Saved Addresses Dropdown -->
                    @if ($addresses->count() > 0)
                        <div class="mb-6 p-4 border border-blue-200 dark:border-blue-800 rounded-lg">
                            <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                                Select from saved addresses:
                            </h3>

                            <select id="saved_address_select"
                                class="w-full px-4 py-2 border border-blue-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                onchange="selectSavedAddress(this.value)">
                                <option value="">-- Choose saved address --</option>

                                @foreach ($addresses as $address)
                                    <option value="{{ $address->id }}">
                                        {{ $address->street_address_1 }}
                                        {{ $address->street_address_2 ? ', ' . $address->street_address_2 : '' }}
                                        - {{ $address->city }}, {{ $address->state }}, {{ $address->country }}
                                    </option>
                                @endforeach
                            </select>

                            <p class="text-xs text-gray-500 dark:text-gray-400 dark:text-gray-500 mt-3">Or enter a new address below</p>
                        </div>
                    @endif

                    {{-- Checkout Form --}}
                    <form action="{{ route('carts.checkout', $cart->id) }}" method="POST">
                        @csrf

                        <!-- Hidden value to know if user selected saved address -->
                        <input type="hidden" name="address_id" id="address_id" value="">

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            <!-- Country -->
                            <div>
                                <label for="country"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Country</label>
                                <input type="text" name="address[country]" id="country" required
                                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="Nepal">
                            </div>

                            <!-- State -->
                            <div>
                                <label for="state" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">State /
                                    Province</label>
                                <input type="text" name="address[state]" id="state" required
                                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="Bagmati">
                            </div>

                            <!-- City -->
                            <div>
                                <label for="city" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">City</label>
                                <input type="text" name="address[city]" id="city" required
                                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="Kathmandu">
                            </div>

                            <!-- Street Address 1 -->
                            <div class="md:col-span-2">
                                <label for="street_address_1" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    Street Address
                                </label>
                                <input type="text" name="address[street_address_1]" id="street_address_1" required
                                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="123 Main St, Apartment, Studio, or Floor">
                            </div>

                            <!-- Street Address 2 -->
                            <div class="md:col-span-2">
                                <label for="street_address_2" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    Street Address 2 (Optional)
                                </label>
                                <input type="text" name="address[street_address_2]" id="street_address_2"
                                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="Additional address info">
                            </div>

                        </div>

                        <!-- Submit Button -->
                        <div class="mt-8">
                            <button type="submit"
                                class="w-full bg-blue-600 hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600 text-white font-bold py-3 px-4 rounded-lg transition duration-300 flex items-center justify-center">
                                Place Order
                                <i class="fas fa-arrow-right ml-2"></i>
                            </button>
                        </div>

                    </form>

                </div>
            </div>

            <!-- Order Summary -->
            <div class="lg:w-1/3">
                <div class="bg-white dark:bg-slate-900 rounded-lg shadow-md p-6 sticky top-4">

                    <h2 class="text-xl font-semibold mb-6 text-gray-700 dark:text-gray-300 flex items-center">
                        <i class="fas fa-shopping-cart mr-2 text-blue-600 dark:text-blue-400"></i>
                        Order Summary
                    </h2>

                    <div class="space-y-4 max-h-96 overflow-y-auto pr-2 custom-scrollbar">
                        @foreach ($cart->cartItems as $item)
                            <div class="flex items-center justify-between border-b pb-4 last:border-0">

                                <div class="flex items-center space-x-4">
                                    <div class="w-16 h-16 bg-gray-100 dark:bg-slate-800 rounded-md overflow-hidden flex-shrink-0">
                                        <img src="{{ $item->product->image_url }}" alt="{{ $item->product->name }}"
                                            class="w-full h-full object-cover">
                                    </div>

                                    <div>
                                        <h3 class="text-sm font-medium text-gray-900 dark:text-white line-clamp-1">
                                            {{ $item->product->name }}
                                        </h3>
                                        <p class="text-xs text-gray-500 dark:text-gray-400 dark:text-gray-500">Qty: {{ $item->quantity }}</p>
                                    </div>
                                </div>

                                <div class="text-sm font-semibold text-gray-900 dark:text-white">
                                    NPR {{ number_format($item->product->price * $item->quantity, 2) }}
                                </div>

                            </div>
                        @endforeach
                    </div>

                    <div class="mt-6 border-t pt-6 space-y-2">
                        <div class="flex justify-between text-gray-600 dark:text-gray-300">
                            <span>Subtotal</span>
                            <span>NPR
                                {{ number_format($cart->cartItems->sum(fn($i) => $i->product->price * $i->quantity), 2) }}</span>
                        </div>

                        <!-- Coupon Section -->
                        <div class="py-4 border-b border-gray-200 dark:border-gray-700">
                            @if(session()->has('coupon_code'))
                                <div class="bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-800 rounded-lg p-3 mb-2">
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <p class="text-sm font-medium text-green-800 dark:text-green-300">Coupon Applied</p>
                                            <p class="text-xs text-green-600 dark:text-green-400 font-mono font-bold">{{ session('coupon_code') }}</p>
                                        </div>
                                        <form action="{{ route('carts.remove-coupon') }}" method="POST">
                                            @csrf
                                            <button type="submit" class="text-red-500 hover:text-red-700 text-xs font-medium uppercase">Remove</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="flex justify-between text-green-600 dark:text-green-400 font-medium">
                                    <span>Discount</span>
                                    <span>- NPR {{ number_format($discountAmount, 2) }}</span>
                                </div>
                            @else
                                <form action="{{ route('carts.apply-coupon') }}" method="POST" class="flex gap-2 mt-2">
                                    @csrf
                                    <input type="text" name="code" placeholder="Coupon Code" required
                                        class="flex-1 px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-800 dark:text-white text-sm">
                                    <button type="submit" class="px-4 py-2 bg-gray-800 dark:bg-gray-700 text-white rounded-lg hover:bg-gray-700 dark:hover:bg-gray-600 text-sm font-medium">
                                        Apply
                                    </button>
                                </form>
                            @endif
                        </div>

                        <div class="flex justify-between text-gray-600 dark:text-gray-300">
                            <span>Tax (10%)</span>
                            @php
                                $subtotal = $cart->cartItems->sum(fn($i) => $i->product->price * $i->quantity);
                                $taxableAmount = max(0, $subtotal - ($discountAmount ?? 0));
                                $tax = $taxableAmount * 0.10;
                            @endphp
                            <span>NPR {{ number_format($tax, 2) }}</span>
                        </div>

                        <div class="flex justify-between text-gray-600 dark:text-gray-300">
                            <span>Shipping</span>
                            <span class="text-green-600">Free</span>
                        </div>

                        <div class="flex justify-between text-xl font-bold text-gray-900 dark:text-white pt-4 border-t border-gray-200 dark:border-gray-700 mt-4">
                            <span>Total</span>
                            <span>NPR
                                {{ number_format($taxableAmount + $tax, 2) }}</span>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <!-- JS Address Autofill -->
    <script>
        const addressData = @json($addresses->keyBy('id'));

        function selectSavedAddress(id) {
            if (!id) {
                document.getElementById('address_id').value = "";
                return;
            }

            const address = addressData[id];

            document.getElementById('address_id').value = address.id;
            document.getElementById('country').value = address.country;
            document.getElementById('state').value = address.state;
            document.getElementById('city').value = address.city;
            document.getElementById('street_address_1').value = address.street_address_1;
            document.getElementById('street_address_2').value = address.street_address_2 ?? '';
        }

        ['country', 'state', 'city', 'street_address_1', 'street_address_2']
        .forEach(field => {
            document.getElementById(field).addEventListener('input', () => {
                document.getElementById('address_id').value = "";
                document.getElementById('saved_address_select').value = "";
            });
        });
    </script>

</x-layouts.user>
