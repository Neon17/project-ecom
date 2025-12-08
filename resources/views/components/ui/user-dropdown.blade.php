@props(['user'])

<div class="relative" x-data="{ 
    open: false,
    darkMode: localStorage.getItem('theme') === 'dark' || (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)
}">
    <!-- Dropdown Toggle Button -->
    <button @click="open = !open" @click.outside="open = false" 
        class="flex items-center gap-2 focus:outline-none">
        @if($user->profile_photo_path)
            <img src="{{ asset('storage/' . $user->profile_photo_path) }}" 
                 alt="{{ $user->name }}" 
                 class="w-9 h-9 rounded-full object-cover border-2 border-white/30 hover:border-white transition-colors">
        @else
            @php
                $nameParts = explode(' ', $user->name);
                $initials = strtoupper(substr($nameParts[0], 0, 1));
                if (count($nameParts) > 1) {
                    $initials .= strtoupper(substr(end($nameParts), 0, 1));
                }
            @endphp
            <div class="w-9 h-9 rounded-full bg-blue-600 dark:bg-blue-500 flex items-center justify-center text-white font-bold text-sm border-2 border-white/30 hover:border-white transition-colors">
                {{ $initials }}
            </div>
        @endif
        <svg class="w-4 h-4 text-white transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
        </svg>
    </button>

    <!-- Dropdown Menu -->
    <div x-show="open" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-100"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         class="absolute right-0 mt-2 w-56 bg-white dark:bg-slate-800 rounded-xl shadow-xl border border-gray-100 dark:border-gray-700 py-2 z-50">
        
        <!-- User Info Header -->
        <div class="px-4 py-3 border-b border-gray-100 dark:border-gray-700">
            <p class="text-sm font-semibold text-gray-900 dark:text-white truncate">{{ $user->name }}</p>
            <p class="text-xs text-gray-500 dark:text-gray-400 truncate">{{ $user->email }}</p>
        </div>

        <!-- Theme Toggle -->
        <div class="px-4 py-3 border-b border-gray-100 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <span class="text-sm text-gray-700 dark:text-gray-300">Dark Mode</span>
                <button @click="
                    darkMode = !darkMode;
                    if (darkMode) {
                        document.documentElement.classList.add('dark');
                        localStorage.setItem('theme', 'dark');
                    } else {
                        document.documentElement.classList.remove('dark');
                        localStorage.setItem('theme', 'light');
                    }
                " 
                    class="relative inline-flex h-6 w-11 items-center rounded-full transition-colors"
                    :class="darkMode ? 'bg-blue-600' : 'bg-gray-300 dark:bg-slate-600'">
                    <span class="inline-block h-4 w-4 transform rounded-full bg-white shadow-sm transition-transform"
                        :class="darkMode ? 'translate-x-6' : 'translate-x-1'"></span>
                </button>
            </div>
        </div>

        <!-- Menu Items -->
        <div class="py-1">
            @if($user->role->value === 'admin')
                <a href="{{ route('admin.dashboard.index') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-slate-700">
                    <i class="fas fa-tachometer-alt w-5 mr-2 text-gray-400"></i>
                    Admin Dashboard
                </a>
            @else
                <a href="{{ route('user.dashboard.index') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-slate-700">
                    <i class="fas fa-home w-5 mr-2 text-gray-400"></i>
                    Dashboard
                </a>
            @endif
            
            <a href="{{ route('user.profile.edit') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-slate-700">
                <i class="fas fa-user w-5 mr-2 text-gray-400"></i>
                My Profile
            </a>

            <a href="{{ route('user.orders.index') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-slate-700">
                <i class="fas fa-shopping-bag w-5 mr-2 text-gray-400"></i>
                My Orders
            </a>
        </div>

        <!-- Logout -->
        <div class="border-t border-gray-100 dark:border-gray-700 py-1">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="flex items-center w-full px-4 py-2 text-sm text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20">
                    <i class="fas fa-sign-out-alt w-5 mr-2"></i>
                    Logout
                </button>
            </form>
        </div>
    </div>
</div>
