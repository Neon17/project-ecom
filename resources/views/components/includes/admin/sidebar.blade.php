<div class="min-h-screen flex">
    <div class="w-64 bg-blue-800 dark:bg-slate-800 fixed h-full text-white border-r border-blue-900 dark:border-slate-700 top-16 bottom-0 overflow-y-auto">
        <div class="p-5 border-b border-blue-900 dark:border-slate-700">
            <h2 class="text-xl font-bold text-white">Admin Panel</h2>
            <p class="text-xs text-blue-100 dark:text-slate-300 mt-1">Management Console</p>
        </div>

        <nav class="mt-4 pb-8">
            <a href="{{ route('admin.dashboard.index') }}" 
               class="flex items-center px-5 py-3 text-blue-100 dark:text-slate-300 hover:bg-blue-900/50 dark:hover:bg-slate-700 hover:text-white transition-all duration-200 {{ request()->routeIs('admin.dashboard*') ? 'bg-blue-900 dark:bg-slate-700 text-white border-l-4 border-white shadow-lg' : '' }}">
                <i class="fas fa-chart-line w-5 mr-3"></i>
                <span class="font-medium">Dashboard</span>
            </a>

            <a href="{{ route('admin.users.index') }}" 
               class="flex items-center px-5 py-3 text-blue-100 dark:text-slate-300 hover:bg-blue-900/50 dark:hover:bg-slate-700 hover:text-white transition-all duration-200 {{ request()->routeIs('admin.users*') ? 'bg-blue-900 dark:bg-slate-700 text-white border-l-4 border-white shadow-lg' : '' }}">
                <i class="fas fa-users w-5 mr-3"></i>
                <span class="font-medium">Users</span>
            </a>

            <a href="{{ route('admin.categories.index') }}" 
               class="flex items-center px-5 py-3 text-blue-100 dark:text-slate-300 hover:bg-blue-900/50 dark:hover:bg-slate-700 hover:text-white transition-all duration-200 {{ request()->routeIs('admin.categories*') ? 'bg-blue-900 dark:bg-slate-700 text-white border-l-4 border-white shadow-lg' : '' }}">
                <i class="fas fa-tags w-5 mr-3"></i>
                <span class="font-medium">Categories</span>
            </a>

            <a href="{{ route('admin.products.index') }}" 
               class="flex items-center px-5 py-3 text-blue-100 dark:text-slate-300 hover:bg-blue-900/50 dark:hover:bg-slate-700 hover:text-white transition-all duration-200 {{ request()->routeIs('admin.products*') ? 'bg-blue-900 dark:bg-slate-700 text-white border-l-4 border-white shadow-lg' : '' }}">
                <i class="fas fa-box w-5 mr-3"></i>
                <span class="font-medium">Products</span>
            </a>

            <a href="{{ route('admin.carts.index') }}" 
               class="flex items-center px-5 py-3 text-blue-100 dark:text-slate-300 hover:bg-blue-900/50 dark:hover:bg-slate-700 hover:text-white transition-all duration-200 {{ request()->routeIs('admin.carts*') ? 'bg-blue-900 dark:bg-slate-700 text-white border-l-4 border-white shadow-lg' : '' }}">
                <i class="fas fa-shopping-cart w-5 mr-3"></i>
                <span class="font-medium">Carts</span>
            </a>

            <a href="{{ route('admin.orders.index') }}" 
               class="flex items-center px-5 py-3 text-blue-100 dark:text-slate-300 hover:bg-blue-900/50 dark:hover:bg-slate-700 hover:text-white transition-all duration-200 {{ request()->routeIs('admin.orders*') ? 'bg-blue-900 dark:bg-slate-700 text-white border-l-4 border-white shadow-lg' : '' }}">
                <i class="fas fa-shopping-bag w-5 mr-3"></i>
                <span class="font-medium">Orders</span>
            </a>

            <a href="{{ route('admin.payments.index') }}" 
               class="flex items-center px-5 py-3 text-blue-100 dark:text-slate-300 hover:bg-blue-900/50 dark:hover:bg-slate-700 hover:text-white transition-all duration-200 {{ request()->routeIs('admin.payments*') ? 'bg-blue-900 dark:bg-slate-700 text-white border-l-4 border-white shadow-lg' : '' }}">
                <i class="fas fa-credit-card w-5 mr-3"></i>
                <span class="font-medium">Payments</span>
            </a>

            <a href="{{ route('admin.addresses.all') }}" 
               class="flex items-center px-5 py-3 text-blue-100 dark:text-slate-300 hover:bg-blue-900/50 dark:hover:bg-slate-700 hover:text-white transition-all duration-200 {{ request()->routeIs('admin.addresses*') ? 'bg-blue-900 dark:bg-slate-700 text-white border-l-4 border-white shadow-lg' : '' }}">
                <i class="fas fa-map-marked-alt w-5 mr-3"></i>
                <span class="font-medium">Addresses</span>
            </a>
        </nav>
    </div>
</div>