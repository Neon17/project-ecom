<nav class="bg-blue-800 dark:bg-slate-800 border-b border-blue-900 dark:border-slate-700 sticky top-0 z-50 shadow-md" x-data="{ mobileMenuOpen: false }">
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

                <a href="{{ route('products.index') }}" class="hidden md:block text-blue-100 dark:text-slate-300 hover:text-white dark:hover:text-white font-medium">
                    Products
                </a>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center gap-4">
                @guest
                    <a href="{{ url('/login') }}" class="text-white hover:text-blue-100 dark:hover:text-slate-200 font-medium">
                        Login
                    </a>
                    <a href="{{ url('/register') }}" class="bg-white text-blue-800 dark:bg-slate-700 dark:text-white px-4 py-2 rounded hover:bg-blue-50 dark:hover:bg-slate-600 font-semibold">
                        Sign Up
                    </a>
                @else
                    @if (auth()->user()->role->value == 'admin')
                        <a href="{{ route('admin.dashboard.index') }}" class="text-white hover:text-blue-100 dark:hover:text-slate-200">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('user.dashboard.index') }}" class="text-white hover:text-blue-100 dark:hover:text-slate-200">
                            Dashboard
                        </a>
                    @endif

                    <livewire:cart-logo />

                    <form action="{{ url('/logout') }}" method="POST" class="m-0">
                        @csrf
                        <button type="submit" class="text-white hover:text-red-300 dark:hover:text-red-400">
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
                        <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path x-show="mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div x-show="mobileMenuOpen" 
             x-transition
             class="md:hidden pb-4 space-y-2">
            <a href="{{ route('products.index') }}" class="block px-4 py-2 text-blue-100 dark:text-slate-300 hover:bg-blue-700 dark:hover:bg-slate-700 rounded font-medium">
                Products
            </a>
            @guest
                <a href="{{ url('/login') }}" class="block px-4 py-2 text-white hover:bg-blue-700 dark:hover:bg-slate-700 rounded font-medium">
                    Login
                </a>
                <a href="{{ url('/register') }}" class="block px-4 py-2 text-white hover:bg-blue-700 dark:hover:bg-slate-700 rounded font-medium">
                    Sign Up
                </a>
            @else
                @if (auth()->user()->role->value == 'admin')
                    <a href="{{ route('admin.dashboard.index') }}" class="block px-4 py-2 text-white hover:bg-blue-700 dark:hover:bg-slate-700 rounded">
                        Admin Dashboard
                    </a>
                @else
                    <a href="{{ route('user.dashboard.index') }}" class="block px-4 py-2 text-white hover:bg-blue-700 dark:hover:bg-slate-700 rounded">
                        Dashboard
                    </a>
                @endif

                <a href="{{ route('user.cart.index') }}" class="block px-4 py-2 text-white hover:bg-blue-700 dark:hover:bg-slate-700 rounded">
                    Cart
                </a>

                <form action="{{ url('/logout') }}" method="POST" class="px-4">
                    @csrf
                    <button type="submit" class="w-full text-left py-2 text-white hover:text-red-300 dark:hover:text-red-400">
                        Logout
                    </button>
                </form>
            @endguest
        </div>
    </div>
</nav>
