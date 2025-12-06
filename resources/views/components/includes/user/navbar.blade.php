<nav class="bg-blue-800 dark:bg-slate-800 border-b border-blue-900 dark:border-slate-700 sticky top-0 z-50 shadow-md"
    x-data="{ mobileMenuOpen: false }">
    <div class="mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">

            <div class="flex items-center gap-6">
                <a href="{{ route('welcome') }}"
                    class="flex items-center gap-2 text-xl font-bold text-white hover:text-blue-100 dark:hover:text-slate-200">
                    <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                    <span>Ecommerce</span>
                </a>

                <div class="hidden md:flex items-center gap-6">
                    <a href="{{ route('products.index') }}"
                        class="text-blue-100 dark:text-slate-300 hover:text-white dark:hover:text-white font-medium">
                        About
                    </a>
                    <a href="{{ route('contact') }}"
                        class="text-blue-100 dark:text-slate-300 hover:text-white dark:hover:text-white font-medium">
                        Contact
                    </a>
                </div>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center gap-4">
                @guest
                    <a href="{{ route('login') }}"
                        class="text-white hover:text-blue-100 dark:hover:text-slate-200 font-medium">
                        Login
                    </a>
                    <a href="{{ route('register') }}"
                        class="bg-white text-blue-800 dark:bg-slate-700 dark:text-white px-4 py-2 rounded hover:bg-blue-50 dark:hover:bg-slate-600 font-semibold">
                        Sign Up
                    </a>
                @else
                    @if (auth()->user()->role->value == 'admin')
                        <a href="{{ route('admin.dashboard.index') }}"
                            class="text-white hover:text-blue-100 dark:hover:text-slate-200">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('user.dashboard.index') }}"
                            class="text-white hover:text-blue-100 dark:hover:text-slate-200">
                            Dashboard
                        </a>
                    @endif

                    <livewire:cart-widget mode="logo" />

                    <form action="{{ route('logout') }}" method="POST" class="m-0">
                        @csrf
                        <button type="submit" class="text-white hover:text-blue-100 dark:hover:text-slate-200">
                            Logout
                        </button>
                    </form>
                @endguest

                <!-- Theme Toggle -->
                <x-ui.theme-toggle />
            </div>

            <!-- Mobile Menu Button -->
            <div class="flex md:hidden items-center gap-2">
                <!-- Theme Toggle Mobile -->
                <x-ui.theme-toggle />

                <button @click="mobileMenuOpen = !mobileMenuOpen" class="p-2 text-white">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path x-show="mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div x-show="mobileMenuOpen" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 -translate-y-1" x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-1" class="md:hidden pb-4 space-y-2">
            <a href="{{ route('products.index') }}"
                class="block px-4 py-2 text-blue-100 dark:text-slate-300 hover:bg-blue-700 dark:hover:bg-slate-700 rounded font-medium">
                Products
            </a>
            <a href="{{ route('about') }}"
                class="block px-4 py-2 text-blue-100 dark:text-slate-300 hover:bg-blue-700 dark:hover:bg-slate-700 rounded font-medium">
                About
            </a>
            <a href="{{ route('contact') }}"
                class="block px-4 py-2 text-blue-100 dark:text-slate-300 hover:bg-blue-700 dark:hover:bg-slate-700 rounded font-medium">
                Contact
            </a>
            @guest
                <a href="{{ route('login') }}"
                    class="block px-4 py-2 text-white hover:bg-blue-700 dark:hover:bg-slate-700 rounded font-medium">
                    Login
                </a>
                <a href="{{ route('register') }}"
                    class="block px-4 py-2 text-white hover:bg-blue-700 dark:hover:bg-slate-700 rounded font-medium">
                    Sign Up
                </a>
            @else
                @if (auth()->user()->role->value == 'admin')
                    <a href="{{ route('admin.dashboard.index') }}"
                        class="block px-4 py-2 text-white hover:bg-blue-700 dark:hover:bg-slate-700 rounded">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('user.dashboard.index') }}"
                        class="block px-4 py-2 text-white hover:bg-blue-700 dark:hover:bg-slate-700 rounded">
                        Dashboard
                    </a>
                @endif

                <a href="{{ route('user.cart.index') }}"
                    class="block px-4 py-2 text-white hover:bg-blue-700 dark:hover:bg-slate-700 rounded">
                    Cart
                    @if (auth()->user()->cart && auth()->user()->cart->cartItems->count() > 0)
                        ({{ auth()->user()->cart->cartItems->sum('quantity') }})
                    @endif
                </a>

                <form action="{{ route('logout') }}" method="POST" class="px-4">
                    @csrf
                    <button type="submit"
                        class="w-full text-left py-2 text-white hover:text-blue-100 dark:hover:text-slate-200">
                        Logout
                    </button>
                </form>
            @endguest
        </div>
    </div>
</nav>
