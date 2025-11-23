<x-layouts.header />
<x-includes.admin.navbar />

<div class="flex h-full w-full">
    <x-ui.success-error-topup />

    <div class="slot w-full min-h-screen p-3">
        @yield('content')
    </div>

</div>


<x-layouts.footer />
