<x-layouts.header />
<x-includes.user.navbar />

<div class="flex w-full">
    <x-ui.success-error-topup />

    <div class="w-full min-h-[calc(100vh-80px)]">
        {{ $slot }}
    </div>
</div>

<x-layouts.footer />
