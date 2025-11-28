<x-layouts.header />
    <x-includes.admin.navbar />

    <div class="flex min-h-screen w-full dark:bg-slate-900" x-data="{ sidebarOpen: false }">
        <x-ui.success-error-topup />

        <!-- Sidebar Overlay for Mobile -->
        <div x-show="sidebarOpen" 
             @click="sidebarOpen = false"
             x-transition
             class="fixed inset-0 bg-gray-900 bg-opacity-50 lg:hidden z-40"></div>

        <!-- Sidebar -->
        <div :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
             class="fixed lg:translate-x-0 lg:static inset-y-0 left-0 z-50 lg:z-auto transition-transform duration-300 ease-in-out">
            <x-includes.admin.sidebar />
        </div>

        <!-- Mobile Sidebar Toggle Button -->
        <button @click="sidebarOpen = !sidebarOpen"
                class="lg:hidden fixed bottom-4 right-4 z-30 bg-blue-600 dark:bg-slate-700 text-white p-3 rounded-full shadow-lg hover:bg-blue-700 dark:hover:bg-slate-600">
            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>

        <div class="slot w-full h-full lg:ml-64 flex-1 p-4 md:p-6">
            {{$slot}}
        </div>

    </div>

<x-layouts.footer />