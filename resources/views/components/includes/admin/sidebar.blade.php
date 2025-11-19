<div class="min-h-screen flex">
    <div class="w-64 bg-gray-800 fixed h-full text-white">
        <div class="p-5 border-b border-gray-700">
            <h2 class="text-xl font-bold text-white">Admin Panel</h2>
        </div>

        <nav class="mt-4">
            <a href="{{ route('admin.dashboard.index') }}" 
               class="block px-5 py-3 text-gray-300 hover:bg-gray-700 {{ request()->routeIs('admin.dashboard*') ? 'bg-gray-700 text-white border-l-4 border-blue-500' : '' }}">
                Dashboard
            </a>

            <a href="{{ route('admin.users.index') }}" 
               class="block px-5 py-3 text-gray-300 hover:bg-gray-700 {{ request()->routeIs('admin.users*') ? 'bg-gray-700 text-white border-l-4 border-blue-500' : '' }}">
                Users
            </a>

            <a href="{{ route('admin.categories.index') }}" 
               class="block px-5 py-3 text-gray-300 hover:bg-gray-700 {{ request()->routeIs('admin.categories*') ? 'bg-gray-700 text-white border-l-4 border-blue-500' : '' }}">
                Categories
            </a>

            <a href="{{ route('admin.products.index') }}" 
               class="block px-5 py-3 text-gray-300 hover:bg-gray-700 {{ request()->routeIs('admin.products*') ? 'bg-gray-700 text-white border-l-4 border-blue-500' : '' }}">
                Products
            </a>

            <a href="{{ route('admin.orders.index') }}" 
               class="block px-5 py-3 text-gray-300 hover:bg-gray-700 {{ request()->routeIs('admin.orders*') ? 'bg-gray-700 text-white border-l-4 border-blue-500' : '' }}">
                Orders
            </a>

            <a href="{{ route('admin.payments.index') }}" 
               class="block px-5 py-3 text-gray-300 hover:bg-gray-700 {{ request()->routeIs('admin.payments*') ? 'bg-gray-700 text-white border-l-4 border-blue-500' : '' }}">
                Payments
            </a>

            <a href="{{ route('admin.addresses.all') }}" 
               class="block px-5 py-3 text-gray-300 hover:bg-gray-700 {{ request()->routeIs('admin.addresses*') ? 'bg-gray-700 text-white border-l-4 border-blue-500' : '' }}">
                Addresses
            </a>
        </nav>
    </div>
</div>
