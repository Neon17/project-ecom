<x-layouts.header />
<x-includes.user.navbar />

<div class="flex w-full">
    <x-ui.success-error-topup />
    <x-ui.cart-modal />

    <div class="w-full min-h-[calc(100vh-80px)] px-4 py-6">
        @yield('content')
    </div>
</div>

<x-layouts.footer />
