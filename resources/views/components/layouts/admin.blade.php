<x-layouts.header />
    <x-includes.admin.navbar />

    <div class="flex min-h-screen w-full">
        <x-includes.admin.sidebar />
        <x-ui.success-error-topup />


        <div class="slot w-full h-full ml-64 flex-1 p-6">
            {{$slot}}
        </div>

    </div>

<x-layouts.footer />