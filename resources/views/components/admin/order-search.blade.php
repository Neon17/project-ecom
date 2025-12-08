@props(['orders', 'name' => 'order_id', 'value' => null])

<div x-data="{
    search: '',
    selectedOrder: null,
    open: false,
    orders: {{ $orders->map(fn($o) => [
        'id' => $o->id,
        'user_name' => $o->user->name,
        'user_email' => $o->user->email,
        'user_phone' => $o->user->phone,
        'user_photo_url' => $o->user->profile_photo_url,
        'address_string' => $o->address->city . ', ' . $o->address->country,
        'has_payment' => $o->payment !== null,
        'payment_status' => $o->payment?->status ?? null,
        'total' => $o->total,
    ])->toJson() }},
    get filteredOrders() {
        if (this.search === '') {
            return this.orders.slice(0, 10);
        }
        const lowerSearch = this.search.toLowerCase();
        return this.orders.filter(order => 
            order.id.toString().includes(lowerSearch) ||
            order.user_name.toLowerCase().includes(lowerSearch) || 
            order.user_email.toLowerCase().includes(lowerSearch) || 
            (order.user_phone && order.user_phone.includes(lowerSearch))
        ).slice(0, 10);
    },
    selectOrder(order) {
        this.selectedOrder = order;
        this.search = '';
        this.open = false;
    },
    clearSelection() {
        this.selectedOrder = null;
        this.search = '';
        this.open = true;
        this.$nextTick(() => this.$refs.searchInput.focus());
    },
    init() {
        if ('{{ $value }}') {
            this.selectedOrder = this.orders.find(o => o.id == '{{ $value }}');
        }
    }
}" class="relative" @click.outside="open = false">

    <input type="hidden" name="{{ $name }}" x-bind:value="selectedOrder ? selectedOrder.id : ''" required>

    <template x-if="selectedOrder">
        <div class="flex items-center justify-between p-3 border border-blue-200 dark:border-blue-800 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
            <div class="flex items-center space-x-3">
                <img x-bind:src="selectedOrder.user_photo_url" x-bind:alt="selectedOrder.user_name" class="w-10 h-10 rounded-full object-cover">
                <div>
                    <div class="font-medium text-gray-900 dark:text-white">
                        Order #<span x-text="selectedOrder.id"></span> - <span x-text="selectedOrder.user_name"></span>
                    </div>
                    <div class="text-sm text-gray-500 dark:text-gray-400">
                        <span x-text="selectedOrder.user_email"></span>
                        <template x-if="selectedOrder.user_phone">
                            <span> • <span x-text="selectedOrder.user_phone"></span></span>
                        </template>
                    </div>
                </div>
            </div>
            <button type="button" x-on:click="clearSelection" class="text-gray-400 hover:text-red-500">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </template>

    <template x-if="!selectedOrder">
        <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </div>
            <input type="text" 
                   x-ref="searchInput"
                   x-model="search"
                   @focus="open = true"
                   @input="open = true"
                   class="block w-full pl-10 pr-3 py-3 border border-gray-200 dark:border-slate-700 rounded-lg leading-5 bg-white dark:bg-slate-900 placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition duration-150 ease-in-out"
                   placeholder="Search by Order ID, Name, Email..."
                   autocomplete="off">
            
            <div x-show="open && filteredOrders.length > 0" 
                 class="absolute z-50 mt-1 w-full bg-white dark:bg-slate-800 shadow-lg max-h-60 rounded-md py-1 text-base ring-1 ring-black ring-opacity-5 overflow-auto focus:outline-none sm:text-sm"
                 style="display: none;">
                <template x-for="order in filteredOrders" :key="order.id">
                    <div x-on:click="selectOrder(order)" 
                         class="cursor-pointer select-none relative py-2 pl-3 pr-9 hover:bg-gray-100 dark:hover:bg-slate-700 transition duration-150 ease-in-out">
                        <div class="flex items-center">
                            <img x-bind:src="order.user_photo_url" alt="" class="h-8 w-8 rounded-full object-cover">
                            <div class="ml-3 flex-1">
                                <span class="block font-medium truncate text-gray-900 dark:text-white">
                                    Order #<span x-text="order.id"></span> - <span x-text="order.user_name"></span>
                                    <template x-if="order.has_payment">
                                        <span class="ml-2 inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800">Has Payment</span>
                                    </template>
                                    <template x-if="!order.has_payment">
                                        <span class="ml-2 inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-yellow-100 text-yellow-800">No Payment</span>
                                    </template>
                                </span>
                                <span class="block text-xs text-gray-500 dark:text-gray-400">
                                    <span x-text="order.user_email"></span>
                                    <template x-if="order.user_phone">
                                        <span> • <span x-text="order.user_phone"></span></span>
                                    </template>
                                    <span> • NPR <span x-text="(order.total).toLocaleString()"></span></span>
                                </span>
                                <span class="block text-xs text-gray-400 dark:text-gray-500" x-text="order.address_string"></span>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
            
            <div x-show="open && filteredOrders.length === 0 && search.length > 0" 
                 class="absolute z-50 mt-1 w-full bg-white dark:bg-slate-800 shadow-lg rounded-md py-2 px-4 text-sm text-gray-500 dark:text-gray-400"
                 style="display: none;">
                No orders found.
            </div>
        </div>
    </template>
</div>
