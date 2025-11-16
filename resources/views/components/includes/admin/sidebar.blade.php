<div class="min-h-[calc(100vh-80px)] flex flex-col w-60 bg-green-50 flxed">

    <div class="min-h-[calc(100vh-80px)] flex flex-col w-60 bg-green-50 fixed">
        <div class="panel-heading-wrapper text-2xl text-center py-5">
            <div class="text-wrapper w-20 text-center border-b mx-auto">
                Admin
            </div>
        </div>

        <a href="{{ route('admin.dashboard.index') }}"
            class="py-4 flex justify-center {{ request()->routeIs('admin.dashboard*') ? 'bg-cyan-200' : '' }} hover:bg-cyan-100 hover:cursor-pointer">
            Dashboard
        </a>
        <a href="{{ route('admin.users.index') }}"
            class="py-4 flex justify-center {{ request()->routeIs('admin.users*') ? 'bg-cyan-200' : '' }} hover:bg-cyan-100 hover:cursor-pointer">
            User
        </a>
        <a href="{{ route('admin.categories.index') }}"
            class="py-4 flex justify-center {{ request()->routeIs('admin.categories*') ? 'bg-cyan-200' : '' }} hover:bg-cyan-100 hover:cursor-pointer">
            Category
        </a>
        <a href="{{ route('admin.products.index') }}"
            class="py-4 flex justify-center {{ request()->routeIs('admin.products*') ? 'bg-cyan-200' : '' }} hover:bg-cyan-100 hover:cursor-pointer">
            Product
        </a>
        <a href="{{ route('admin.orders.index') }}"
            class="py-4 flex justify-center {{ request()->routeIs('admin.orders*') ? 'bg-cyan-200' : '' }} hover:bg-cyan-100 hover:cursor-pointer">
            Order
        </a>
        <a href="{{ route('admin.payments.index') }}"
            class="py-4 flex justify-center {{ request()->routeIs('admin.payments*') ? 'bg-cyan-200' : '' }} hover:bg-cyan-100 hover:cursor-pointer">
            Payment
        </a>
        <a href="{{ route('admin.addresses.all') }}"
            class="py-4 flex justify-center {{ request()->routeIs('admin.addresses*') ? 'bg-cyan-200' : '' }} hover:bg-cyan-100 hover:cursor-pointer">
            Address
        </a>
    </div>

</div>
