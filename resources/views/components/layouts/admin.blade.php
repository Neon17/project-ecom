<x-layouts.header />
    <x-includes.admin.navbar />

    <div class="flex h-full w-full">
        <x-ui.success-error-topup />
        <x-ui.cart-modal />

        <x-includes.admin.sidebar />

        <div class="slot w-full h-full ml-64 flex-1 p-6">
            {{$slot}}
        </div>

    </div>

<x-layouts.footer />