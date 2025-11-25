<nav class="bg-blue-800 border-b border-blue-900 sticky top-0 z-50 shadow-md">
    <div class="mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">

            <div class="flex items-center gap-6">
                <a href="{{ route('welcome') }}"
                    class="flex items-center gap-2 text-xl font-bold text-white hover:text-blue-100">
                    <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                    <span>Ecommerce</span>
                </a>

                <a href="{{ route('products.index') }}" class="text-blue-100 hover:text-white font-medium">
                    Products
                </a>
            </div>

            <div class="flex items-center gap-4">
                @guest
                    <a href="{{ route('login') }}" class="text-white hover:text-blue-100 font-medium">
                        Login
                    </a>
                    <a href="{{ route('register') }}"
                        class="bg-white text-blue-800 px-4 py-2 rounded hover:bg-blue-50 font-semibold">
                        Sign Up
                    </a>
                @else
                    @if (auth()->user()->role->value == 'admin')
                        <a href="{{ route('admin.dashboard.index') }}" class="text-white hover:text-blue-100">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('user.dashboard.index') }}" class="text-white hover:text-blue-100">
                            Dashboard
                        </a>
                    @endif

                    <a href="{{ route('user.cart.index') }}" class="relative text-white hover:text-blue-100">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        @if (auth()->user()->cart && auth()->user()->cart->cartItems->count() > 0)
                            <span
                                class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
                                {{ auth()->user()->cart->cartItems->sum('quantity') }}
                            </span>
                        @endif
                    </a>

                    <form action="{{ route('logout') }}" method="POST" class="m-0">
                        @csrf
                        <button type="submit" class="text-white hover:text-blue-100">
                            Logout
                        </button>
                    </form>
                @endguest
            </div>
        </div>
    </div>
</nav>
