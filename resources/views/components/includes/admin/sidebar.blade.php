<div class="min-h-[calc(100vh-80px)] flex flex-col w-60 bg-cyan-50 flxed">

    <a href="{{route('admin.dashboard.index')}}" class="py-4 flex justify-center border-b {{(str_starts_with(request()->path(),'/admin/dashboard'))?'bg-cyan-300':''}} hover:bg-cyan-100 hover:cursor-pointer">
        Dashboard
    </a>
    <a href="{{route('admin.users.index')}}" class="py-4 flex justify-center border-b {{(str_starts_with(request()->path(),'/admin/dashboard'))?'bg-cyan-300':''}} hover:bg-cyan-100 hover:cursor-pointer">
        User
    </a>
    <a href="{{route('admin.categories.index')}}" class="py-4 flex justify-center border-b {{(str_starts_with(request()->path(),'/admin/dashboard'))?'bg-cyan-300':''}} hover:bg-cyan-100 hover:cursor-pointer">
        Category
    </a>
    <a href="{{route('admin.products.index')}}" class="py-4 flex justify-center border-b {{(str_starts_with(request()->path(),'/admin/dashboard'))?'bg-cyan-300':''}} hover:bg-cyan-100 hover:cursor-pointer">
        Product
    </a>
    <a href="{{route('admin.orders.index')}}" class="py-4 flex justify-center border-b {{(str_starts_with(request()->path(),'/admin/dashboard'))?'bg-cyan-300':''}} hover:bg-cyan-100 hover:cursor-pointer">
        Order
    </a>
    <a href="{{route('admin.payments.index')}}" class="py-4 flex justify-center border-b {{(str_starts_with(request()->path(),'/admin/dashboard'))?'bg-cyan-300':''}} hover:bg-cyan-100 hover:cursor-pointer">
        Payment
    </a>

</div>