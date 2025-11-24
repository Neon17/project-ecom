<x-layouts.user>
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-800">My Addresses</h1>
        <p class="text-gray-600">Manage your shipping addresses.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Add New Address Card -->
        <div class="bg-gray-50 border-2 border-dashed border-gray-300 rounded-lg p-6 flex flex-col items-center justify-center text-center hover:bg-gray-100 transition-colors cursor-pointer"
             onclick="document.getElementById('add-address-modal').classList.remove('hidden')">
            <div class="w-12 h-12 rounded-full bg-gray-200 flex items-center justify-center mb-4 text-gray-500">
                <i class="fas fa-plus text-xl"></i>
            </div>
            <h3 class="font-bold text-gray-800">Add New Address</h3>
            <p class="text-sm text-gray-500 mt-1">Add a new shipping destination</p>
        </div>

        @foreach($addresses as $address)
            <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6 relative group">
                <div class="absolute top-4 right-4 opacity-0 group-hover:opacity-100 transition-opacity flex gap-2">
                    <button onclick="editAddress({{ $address }})" class="text-blue-600 hover:text-blue-800 p-1">
                        <i class="fas fa-edit"></i>
                    </button>
                    <form action="{{ route('user.addresses.destroy', $address) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-800 p-1">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </div>

                <div class="flex items-start mb-4">
                    <div class="p-2 rounded bg-blue-50 text-blue-600 mr-3">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-800">Address #{{ $loop->iteration }}</h3>
                        <p class="text-sm text-gray-500">{{ $address->country }}</p>
                    </div>
                </div>

                <div class="text-gray-600 text-sm space-y-1">
                    <p>{{ $address->street_address_1 }}</p>
                    @if($address->street_address_2)
                        <p>{{ $address->street_address_2 }}</p>
                    @endif
                    <p>{{ $address->city }}, {{ $address->state }}</p>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Add Address Modal -->
    <div id="add-address-modal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-md mx-4">
            <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                <h3 class="font-bold text-lg text-gray-800">Add New Address</h3>
                <button onclick="document.getElementById('add-address-modal').classList.add('hidden')" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form action="{{ route('user.addresses.store') }}" method="POST" class="p-6">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Country</label>
                        <input type="text" name="country" required class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">State/Province</label>
                        <input type="text" name="state" required class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">City</label>
                        <input type="text" name="city" required class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Street Address 1</label>
                        <input type="text" name="street_address_1" required class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Street Address 2 (Optional)</label>
                        <input type="text" name="street_address_2" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                    </div>
                </div>
                <div class="mt-6 flex justify-end gap-3">
                    <button type="button" onclick="document.getElementById('add-address-modal').classList.add('hidden')" class="px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-lg">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white hover:bg-blue-700 rounded-lg">Save Address</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Address Modal (Simplified for now, would need JS to populate) -->
    <script>
        function editAddress(address) {
            // Implementation for edit modal population would go here
            // For now, we'll just alert
            alert('Edit functionality to be implemented with a similar modal');
        }
    </script>
</x-layouts.user>
