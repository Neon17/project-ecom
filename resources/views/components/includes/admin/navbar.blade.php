<div class="h-18 bg-cyan-100 flex justify-around items-center w-full p-3 shadow-lg sticky top-0">

    <div class="company-wrapper flex items-center justify-around h-full px-5">

        <a href="{{ route('welcome') }}" class="text-xl mx-3">
            Ecommerce
        </a>

        <div class="main-button-content my-auto">
            <a href="{{ route('products.index') }}"
                class="text-blue-600 p-2 hover:cursor-pointer hover:text-blue-500 rounded">Products</a>
        </div>

        <div class="button-wrapper p-2 flex items-center gap-3">

            @guest

                <div class="button-wrapper p-2">
                    <a href="{{ url('/login') }}"
                        class="bg-blue-600 text-white p-2 hover:cursor-pointer hover:bg-blue-500 rounded">Login</a>
                    <a href="{{ url('/register') }}"
                        class="bg-blue-600 text-white p-2 hover:cursor-pointer hover:bg-blue-500 rounded">Register</a>
                </div>
            @else
                <a href="{{ url('/admin/dashboard') }}"
                    class="bg-blue-600 text-white p-2 hover:cursor-pointer hover:bg-blue-500 rounded">Dashboard</a>
                <button id="open-user-cart-modal"
                    class="bg-blue-600 text-white p-2 hover:cursor-pointer hover:bg-blue-500 rounded">Cart</button>
                <form action="{{ url('/logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="bg-blue-600 text-white p-2 hover:cursor-pointer hover:bg-blue-500 rounded">Logout</button>
                </form>

            @endguest

        </div>

    </div>

</div>
