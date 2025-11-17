<div class="min-h-screen flex">

    <div class="w-64 bg-white shadow-lg fixed h-full">
        
        <div class="p-6 border-b border-gray-200">
            <div class="text-xl font-bold text-gray-800 text-center">
                Admin Panel
            </div>
        </div>

        <nav class="mt-6">
            <a href="{{ route('admin.dashboard.index') }}" 
               class="flex items-center px-6 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors {{ request()->routeIs('admin.dashboard*') ? 'bg-blue-50 text-blue-600 border-r-2 border-blue-600' : '' }}">
                <span class="ml-3 font-medium">Dashboard</span>
            </a>

            <a href="{{ route('admin.users.index') }}" 
               class="flex items-center px-6 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors {{ request()->routeIs('admin.users*') ? 'bg-blue-50 text-blue-600 border-r-2 border-blue-600' : '' }}">
                <span class="ml-3 font-medium">Users</span>
            </a>

            <a href="{{ route('admin.categories.index') }}" 
               class="flex items-center px-6 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors {{ request()->routeIs('admin.categories*') ? 'bg-blue-50 text-blue-600 border-r-2 border-blue-600' : '' }}">
                <span class="ml-3 font-medium">Categories</span>
            </a>

            <a href="{{ route('admin.products.index') }}" 
               class="flex items-center px-6 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors {{ request()->routeIs('admin.products*') ? 'bg-blue-50 text-blue-600 border-r-2 border-blue-600' : '' }}">
                <span class="ml-3 font-medium">Products</span>
            </a>

            <a href="{{ route('admin.orders.index') }}" 
               class="flex items-center px-6 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors {{ request()->routeIs('admin.orders*') ? 'bg-blue-50 text-blue-600 border-r-2 border-blue-600' : '' }}">
                <span class="ml-3 font-medium">Orders</span>
            </a>

            <a href="{{ route('admin.payments.index') }}" 
               class="flex items-center px-6 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors {{ request()->routeIs('admin.payments*') ? 'bg-blue-50 text-blue-600 border-r-2 border-blue-600' : '' }}">
                <span class="ml-3 font-medium">Payments</span>
            </a>

            <a href="{{ route('admin.addresses.all') }}" 
               class="flex items-center px-6 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors {{ request()->routeIs('admin.addresses*') ? 'bg-blue-50 text-blue-600 border-r-2 border-blue-600' : '' }}">
                <span class="ml-3 font-medium">Addresses</span>
            </a>
        </nav>
    </div>
</div>