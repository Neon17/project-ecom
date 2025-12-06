@props(['users', 'name' => 'user_id', 'value' => null])

<div x-data="{
    search: '',
    selectedUser: null,
    open: false,
    users: {{ $users->map(fn($u) => [
        'id' => $u->id,
        'name' => $u->name,
        'email' => $u->email,
        'phone' => $u->phone,
        'profile_photo_url' => $u->profile_photo_url,
        'address_string' => $u->addresses->first() ? $u->addresses->first()->city . ', ' . $u->addresses->first()->country : ''
    ])->toJson() }},
    get filteredUsers() {
        if (this.search === '') {
            return this.users.slice(0, 10);
        }
        const lowerSearch = this.search.toLowerCase();
        return this.users.filter(user => 
            user.name.toLowerCase().includes(lowerSearch) || 
            user.email.toLowerCase().includes(lowerSearch) || 
            (user.phone && user.phone.includes(lowerSearch))
        ).slice(0, 10);
    },
    selectUser(user) {
        this.selectedUser = user;
        this.search = '';
        this.open = false;
    },
    clearSelection() {
        this.selectedUser = null;
        this.search = '';
        this.open = true;
        this.$nextTick(() => this.$refs.searchInput.focus());
    },
    init() {
        if ('{{ $value }}') {
            this.selectedUser = this.users.find(u => u.id == '{{ $value }}');
        }
    }
}" class="relative" @click.outside="open = false">

    <input type="hidden" name="{{ $name }}" x-bind:value="selectedUser ? selectedUser.id : ''" required>

    <template x-if="selectedUser">
        <div class="flex items-center justify-between p-3 border border-blue-200 dark:border-blue-800 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
            <div class="flex items-center space-x-3">
                <img x-bind:src="selectedUser.profile_photo_url" x-bind:alt="selectedUser.name" class="w-10 h-10 rounded-full object-cover">
                <div>
                    <div class="font-medium text-gray-900 dark:text-white" x-text="selectedUser.name"></div>
                    <div class="text-sm text-gray-500 dark:text-gray-400">
                        <span x-text="selectedUser.email"></span>
                        <template x-if="selectedUser.phone">
                            <span> • <span x-text="selectedUser.phone"></span></span>
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

    <template x-if="!selectedUser">
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
                   placeholder="Search by name, email, or phone..."
                   autocomplete="off">
            
            <div x-show="open && filteredUsers.length > 0" 
                 class="absolute z-50 mt-1 w-full bg-white dark:bg-slate-800 shadow-lg max-h-60 rounded-md py-1 text-base ring-1 ring-black ring-opacity-5 overflow-auto focus:outline-none sm:text-sm"
                 style="display: none;">
                <template x-for="user in filteredUsers" :key="user.id">
                    <div x-on:click="selectUser(user)" 
                         class="cursor-pointer select-none relative py-2 pl-3 pr-9 hover:bg-gray-100 dark:hover:bg-slate-700 transition duration-150 ease-in-out">
                        <div class="flex items-center">
                            <img x-bind:src="user.profile_photo_url" alt="" class="h-8 w-8 rounded-full object-cover">
                            <div class="ml-3">
                                <span class="block font-medium truncate text-gray-900 dark:text-white" x-text="user.name"></span>
                                <span class="block text-xs text-gray-500 dark:text-gray-400">
                                    <span x-text="user.email"></span>
                                    <template x-if="user.phone">
                                        <span> • <span x-text="user.phone"></span></span>
                                    </template>
                                    <template x-if="user.address_string">
                                        <span> • <span x-text="user.address_string"></span></span>
                                    </template>
                                </span>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
            
            <div x-show="open && filteredUsers.length === 0 && search.length > 0" 
                 class="absolute z-50 mt-1 w-full bg-white dark:bg-slate-800 shadow-lg rounded-md py-2 px-4 text-sm text-gray-500 dark:text-gray-400"
                 style="display: none;">
                No users found.
            </div>
        </div>
    </template>
</div>
