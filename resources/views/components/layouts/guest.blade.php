<x-layouts.header />
<x-includes.admin.navbar />

<div class="flex h-full w-full">
    <x-ui.success-error-topup />
    <x-ui.cart-modal />

    <div class="slot w-full h-full p-3">
        @yield('content')
    </div>

</div>

<x-layouts.footer />
