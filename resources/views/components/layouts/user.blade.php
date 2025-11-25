<x-layouts.header />
    <x-includes.user.navbar />

    <div class="flex min-h-screen w-full bg-white">
        <x-ui.success-error-topup />

        <div class="hidden md:block">
            <x-includes.user.sidebar />
        </div>

        <div class="flex-1 p-6 md:p-8 overflow-y-auto md:ml-64">
            {{ $slot }}
        </div>

    </div>

<x-layouts.footer />
