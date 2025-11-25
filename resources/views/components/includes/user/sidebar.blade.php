<div class="min-h-screen flex flex-col bg-blue-800 text-white border-r border-blue-900 w-64 fixed left-0 top-16 bottom-0 overflow-y-auto">
    <div class="p-5 border-b border-blue-900">
        <h2 class="text-xl font-bold text-white">My Account</h2>
        <p class="text-sm text-blue-100 mt-1">{{ auth()->user()->name }}</p>
    </div>

    <nav class="flex-1 py-4">
        <a href="{{ route('user.dashboard.index') }}" 
           class="flex items-center px-6 py-3 text-blue-100 hover:bg-blue-900/50 hover:text-white transition-all duration-200 {{ request()->routeIs('user.dashboard*') ? 'bg-blue-900 text-white border-r-4 border-white shadow-lg' : '' }}">
            <i class="fas fa-home w-5 mr-3"></i>
            <span class="font-medium">Dashboard</span>
        </a>

        <a href="{{ route('user.cart.index') }}" 
           class="flex items-center px-6 py-3 text-blue-100 hover:bg-blue-900/50 hover:text-white transition-all duration-200 {{ request()->routeIs('user.cart*') ? 'bg-blue-900 text-white border-r-4 border-white shadow-lg' : '' }}">
            <i class="fas fa-shopping-cart w-5 mr-3"></i>
            <span class="font-medium">My Cart</span>
            @if(auth()->user()->cart && auth()->user()->cart->cartItems->count() > 0)
                <span class="ml-auto bg-white text-blue-800 text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">
                    {{ auth()->user()->cart->cartItems->sum('quantity') }}
                </span>
            @endif
        </a>

        <a href="{{ route('user.orders.index') }}" 
           class="flex items-center px-6 py-3 text-blue-100 hover:bg-blue-900/50 hover:text-white transition-all duration-200 {{ request()->routeIs('user.orders*') ? 'bg-blue-900 text-white border-r-4 border-white shadow-lg' : '' }}">
            <i class="fas fa-shopping-bag w-5 mr-3"></i>
            <span class="font-medium">My Orders</span>
        </a>

        <a href="{{ route('user.addresses.index') }}" 
           class="flex items-center px-6 py-3 text-blue-100 hover:bg-blue-900/50 hover:text-white transition-all duration-200 {{ request()->routeIs('user.addresses*') ? 'bg-blue-900 text-white border-r-4 border-white shadow-lg' : '' }}">
            <i class="fas fa-map-marker-alt w-5 mr-3"></i>
            <span class="font-medium">Addresses</span>
        </a>

        <a href="{{ route('user.profile.edit') }}" 
           class="flex items-center px-6 py-3 text-blue-100 hover:bg-blue-900/50 hover:text-white transition-all duration-200 {{ request()->routeIs('user.profile*') ? 'bg-blue-900 text-white border-r-4 border-white shadow-lg' : '' }}">
            <i class="fas fa-user w-5 mr-3"></i>
            <span class="font-medium">Profile</span>
        </a>
    </nav>
</div>
