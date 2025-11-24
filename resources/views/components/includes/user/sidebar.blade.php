<div class="min-h-screen flex flex-col bg-white border-r w-64">
    <div class="p-5 border-b">
        <h2 class="text-xl font-bold text-gray-800">My Account</h2>
        <p class="text-sm text-gray-500 mt-1">{{ auth()->user()->name }}</p>
    </div>

    <nav class="flex-1 py-4">
        <a href="{{ route('user.dashboard.index') }}" 
           class="flex items-center px-6 py-3 text-gray-600 hover:bg-blue-50 hover:text-blue-600 transition-colors {{ request()->routeIs('user.dashboard*') ? 'bg-blue-50 text-blue-600 border-r-4 border-blue-600' : '' }}">
            <i class="fas fa-home w-5 mr-3"></i>
            Dashboard
        </a>

        <a href="{{ route('user.orders.index') }}" 
           class="flex items-center px-6 py-3 text-gray-600 hover:bg-blue-50 hover:text-blue-600 transition-colors {{ request()->routeIs('user.orders*') ? 'bg-blue-50 text-blue-600 border-r-4 border-blue-600' : '' }}">
            <i class="fas fa-shopping-bag w-5 mr-3"></i>
            My Orders
        </a>

        <a href="{{ route('user.addresses.index') }}" 
           class="flex items-center px-6 py-3 text-gray-600 hover:bg-blue-50 hover:text-blue-600 transition-colors {{ request()->routeIs('user.addresses*') ? 'bg-blue-50 text-blue-600 border-r-4 border-blue-600' : '' }}">
            <i class="fas fa-map-marker-alt w-5 mr-3"></i>
            Addresses
        </a>

        <a href="{{ route('user.profile.edit') }}" 
           class="flex items-center px-6 py-3 text-gray-600 hover:bg-blue-50 hover:text-blue-600 transition-colors {{ request()->routeIs('user.profile*') ? 'bg-blue-50 text-blue-600 border-r-4 border-blue-600' : '' }}">
            <i class="fas fa-user w-5 mr-3"></i>
            Profile
        </a>
    </nav>
</div>
