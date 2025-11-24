<x-layouts.header />
    <x-includes.user.navbar />

    <div class="flex h-full w-full bg-white">
        <x-ui.success-error-topup />
        <x-ui.cart-modal />

        <div class="hidden md:block">
            <x-includes.user.sidebar />
        </div>

        <div class="flex-1 p-6 md:p-8 overflow-y-auto">
            {{ $slot }}
        </div>

    </div>

<x-layouts.footer />
