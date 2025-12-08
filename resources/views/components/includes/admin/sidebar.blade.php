<div class="w-64 bg-blue-800 dark:bg-slate-800 h-screen text-white border-r border-blue-900 dark:border-slate-700 flex flex-col">
    <div class="p-4 md:p-5 border-b border-blue-900 dark:border-slate-700 flex-shrink-0">
        <h2 class="text-lg md:text-xl font-bold text-white">Admin Panel</h2>
        <p class="text-xs text-blue-100 dark:text-slate-300 mt-1">Management Console</p>
    </div>

    <nav class="flex-1 overflow-y-auto py-4">
        <a href="{{ route('admin.dashboard.index') }}" 
           class="flex items-center px-4 md:px-5 py-3 text-blue-100 dark:text-slate-300 hover:bg-blue-900/50 dark:hover:bg-slate-700 hover:text-white transition-all duration-200 {{ request()->routeIs('admin.dashboard*') ? 'bg-blue-900 dark:bg-slate-700 text-white border-l-4 border-white shadow-lg' : '' }}">
            <i class="fas fa-chart-line w-5 mr-3"></i>
            <span class="font-medium">Dashboard</span>
        </a>

        <a href="{{ route('admin.users.index') }}" 
           class="flex items-center px-4 md:px-5 py-3 text-blue-100 dark:text-slate-300 hover:bg-blue-900/50 dark:hover:bg-slate-700 hover:text-white transition-all duration-200 {{ request()->routeIs('admin.users*') ? 'bg-blue-900 dark:bg-slate-700 text-white border-l-4 border-white shadow-lg' : '' }}">
            <i class="fas fa-users w-5 mr-3"></i>
            <span class="font-medium">Users</span>
        </a>

        <a href="{{ route('admin.categories.index') }}" 
           class="flex items-center px-4 md:px-5 py-3 text-blue-100 dark:text-slate-300 hover:bg-blue-900/50 dark:hover:bg-slate-700 hover:text-white transition-all duration-200 {{ request()->routeIs('admin.categories*') ? 'bg-blue-900 dark:bg-slate-700 text-white border-l-4 border-white shadow-lg' : '' }}">
            <i class="fas fa-tags w-5 mr-3"></i>
            <span class="font-medium">Categories</span>
        </a>

        <a href="{{ route('admin.products.index') }}" 
           class="flex items-center px-4 md:px-5 py-3 text-blue-100 dark:text-slate-300 hover:bg-blue-900/50 dark:hover:bg-slate-700 hover:text-white transition-all duration-200 {{ request()->routeIs('admin.products*') ? 'bg-blue-900 dark:bg-slate-700 text-white border-l-4 border-white shadow-lg' : '' }}">
            <i class="fas fa-box w-5 mr-3"></i>
            <span class="font-medium">Products</span>
        </a>

        <a href="{{ route('admin.carts.index') }}" 
           class="flex items-center px-4 md:px-5 py-3 text-blue-100 dark:text-slate-300 hover:bg-blue-900/50 dark:hover:bg-slate-700 hover:text-white transition-all duration-200 {{ request()->routeIs('admin.carts*') ? 'bg-blue-900 dark:bg-slate-700 text-white border-l-4 border-white shadow-lg' : '' }}">
            <i class="fas fa-shopping-cart w-5 mr-3"></i>
            <span class="font-medium">Carts</span>
        </a>

        <a href="{{ route('admin.orders.index') }}" 
           class="flex items-center px-4 md:px-5 py-3 text-blue-100 dark:text-slate-300 hover:bg-blue-900/50 dark:hover:bg-slate-700 hover:text-white transition-all duration-200 {{ request()->routeIs('admin.orders*') ? 'bg-blue-900 dark:bg-slate-700 text-white border-l-4 border-white shadow-lg' : '' }}">
            <i class="fas fa-shopping-bag w-5 mr-3"></i>
            <span class="font-medium">Orders</span>
        </a>

        <a href="{{ route('admin.payments.index') }}" 
           class="flex items-center px-4 md:px-5 py-3 text-blue-100 dark:text-slate-300 hover:bg-blue-900/50 dark:hover:bg-slate-700 hover:text-white transition-all duration-200 {{ request()->routeIs('admin.payments*') ? 'bg-blue-900 dark:bg-slate-700 text-white border-l-4 border-white shadow-lg' : '' }}">
            <i class="fas fa-credit-card w-5 mr-3"></i>
            <span class="font-medium">Payments</span>
        </a>

        <a href="{{ route('admin.coupons.index') }}" 
           class="flex items-center px-4 md:px-5 py-3 text-blue-100 dark:text-slate-300 hover:bg-blue-900/50 dark:hover:bg-slate-700 hover:text-white transition-all duration-200 {{ request()->routeIs('admin.coupons*') ? 'bg-blue-900 dark:bg-slate-700 text-white border-l-4 border-white shadow-lg' : '' }}">
            <i class="fas fa-ticket-alt w-5 mr-3"></i>
            <span class="font-medium">Coupons</span>
        </a>

        <a href="{{ route('admin.addresses.all') }}" 
           class="flex items-center px-4 md:px-5 py-3 text-blue-100 dark:text-slate-300 hover:bg-blue-900/50 dark:hover:bg-slate-700 hover:text-white transition-all duration-200 {{ request()->routeIs('admin.addresses*') ? 'bg-blue-900 dark:bg-slate-700 text-white border-l-4 border-white shadow-lg' : '' }}">
            <i class="fas fa-map-marked-alt w-5 mr-3"></i>
            <span class="font-medium">Addresses</span>
        </a>

        <a href="{{ route('admin.invoices.index') }}" 
           class="flex items-center px-4 md:px-5 py-3 text-blue-100 dark:text-slate-300 hover:bg-blue-900/50 dark:hover:bg-slate-700 hover:text-white transition-all duration-200 {{ request()->routeIs('admin.invoices*') ? 'bg-blue-900 dark:bg-slate-700 text-white border-l-4 border-white shadow-lg' : '' }}">
            <i class="fas fa-file-invoice w-5 mr-3"></i>
            <span class="font-medium">Invoices</span>
        </a>

        <a href="{{ route('admin.contact-messages.index') }}" 
           class="flex items-center px-4 md:px-5 py-3 text-blue-100 dark:text-slate-300 hover:bg-blue-900/50 dark:hover:bg-slate-700 hover:text-white transition-all duration-200 {{ request()->routeIs('admin.contact-messages*') ? 'bg-blue-900 dark:bg-slate-700 text-white border-l-4 border-white shadow-lg' : '' }}">
            <i class="fas fa-envelope w-5 mr-3"></i>
            <span class="font-medium">Messages</span>
            @php $unreadCount = \App\Models\ContactMessage::where('status', 'unread')->count(); @endphp
            @if($unreadCount > 0)
                <span class="ml-auto bg-red-500 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">{{ $unreadCount }}</span>
            @endif
        </a>
    </nav>

    <!-- Footer -->
    <div class="flex-shrink-0 border-t border-blue-900 dark:border-slate-700 p-4 bg-blue-900/30 dark:bg-slate-900/50">
        <p class="text-xs text-blue-100 dark:text-slate-400 text-center">
            &copy; {{ date('Y') }} Ecommerce<br>
            All rights reserved
        </p>
    </div>
</div>