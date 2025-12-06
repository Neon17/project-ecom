<div class="w-64 bg-blue-800 dark:bg-slate-800 h-screen text-white border-r border-blue-900 dark:border-slate-700 flex flex-col">
    <div class="p-4 md:p-5 border-b border-blue-900 dark:border-slate-700 flex-shrink-0">
        <h2 class="text-lg md:text-xl font-bold text-white">My Account</h2>
        <p class="text-xs md:text-sm text-blue-100 dark:text-slate-300 mt-1 truncate">{{ auth()->check() ? auth()->user()->name : 'Guest' }}</p>
    </div>

    <nav class="flex-1 overflow-y-auto py-4">
        @auth
        <a href="{{ route('user.dashboard.index') }}" 
           class="flex items-center px-4 md:px-6 py-3 text-blue-100 dark:text-slate-300 hover:bg-blue-900/50 dark:hover:bg-slate-700 hover:text-white transition-all duration-200 {{ request()->routeIs('user.dashboard*') ? 'bg-blue-900 dark:bg-slate-700 text-white border-r-4 border-white shadow-lg' : '' }}">
            <i class="fas fa-home w-5 mr-3"></i>
            <span class="font-medium">Dashboard</span>
        </a>
        @endauth

        <a href="{{ route('user.cart.index') }}" 
           class="flex items-center px-4 md:px-6 py-3 text-blue-100 dark:text-slate-300 hover:bg-blue-900/50 dark:hover:bg-slate-700 hover:text-white transition-all duration-200 {{ request()->routeIs('user.cart*') ? 'bg-blue-900 dark:bg-slate-700 text-white border-r-4 border-white shadow-lg' : '' }}">
            <i class="fas fa-shopping-cart w-5 mr-3"></i>
            <span class="font-medium">My Cart</span>
            @auth
                @if(auth()->user()->cart && auth()->user()->cart->cartItems->count() > 0)
                    <span class="ml-auto bg-white text-blue-800 dark:bg-slate-300 dark:text-slate-800 text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">
                        {{ auth()->user()->cart->cartItems->sum('quantity') }}
                    </span>
                @endif
            @endauth
        </a>

        @auth
        <a href="{{ route('user.orders.index') }}" 
           class="flex items-center px-4 md:px-6 py-3 text-blue-100 dark:text-slate-300 hover:bg-blue-900/50 dark:hover:bg-slate-700 hover:text-white transition-all duration-200 {{ request()->routeIs('user.orders*') ? 'bg-blue-900 dark:bg-slate-700 text-white border-r-4 border-white shadow-lg' : '' }}">
            <i class="fas fa-shopping-bag w-5 mr-3"></i>
            <span class="font-medium">My Orders</span>
        </a>

        <a href="{{ route('user.addresses.index') }}" 
           class="flex items-center px-4 md:px-6 py-3 text-blue-100 dark:text-slate-300 hover:bg-blue-900/50 dark:hover:bg-slate-700 hover:text-white transition-all duration-200 {{ request()->routeIs('user.addresses*') ? 'bg-blue-900 dark:bg-slate-700 text-white border-r-4 border-white shadow-lg' : '' }}">
            <i class="fas fa-map-marker-alt w-5 mr-3"></i>
            <span class="font-medium">Addresses</span>
        </a>

        <a href="{{ route('user.profile.edit') }}" 
           class="flex items-center px-4 md:px-6 py-3 text-blue-100 dark:text-slate-300 hover:bg-blue-900/50 dark:hover:bg-slate-700 hover:text-white transition-all duration-200 {{ request()->routeIs('user.profile*') ? 'bg-blue-900 dark:bg-slate-700 text-white border-r-4 border-white shadow-lg' : '' }}">
            <i class="fas fa-user w-5 mr-3"></i>
            <span class="font-medium">Profile</span>
        </a>
        @endauth
    </nav>

    <!-- Footer -->
    <div class="flex-shrink-0 border-t border-blue-900 dark:border-slate-700 p-4 bg-blue-900/30 dark:bg-slate-900/50">
        <p class="text-xs text-blue-100 dark:text-slate-400 text-center">
            &copy; {{ date('Y') }} Ecommerce<br>
            All rights reserved
        </p>
    </div>
</div>
