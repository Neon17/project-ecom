<div class="h-18 bg-cyan-100 flex justify-around items-center w-full p-3 shadow-lg sticky top-0">

    <div class="company-wrapper flex items-center h-full px-5">

        <h2 class="text-xl">
            Ecommerce
        </h2>

        <div class="button-wrapper p-2">

            @guest

                <div class="button-wrapper p-2">
                    <a href="{{ url('/login') }}"
                        class="bg-blue-600 text-white p-2 hover:cursor-pointer hover:bg-blue-500 rounded">Login</a>
                    <a href="{{ url('/register') }}"
                        class="bg-blue-600 text-white p-2 hover:cursor-pointer hover:bg-blue-500 rounded">Register</a>
                </div>
            @else
                <form action="{{ url('/logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="bg-blue-600 text-white p-2 hover:cursor-pointer hover:bg-blue-500 rounded">Logout</button>
                </form>

            @endguest

            @if (auth()->user() && auth()->user()->role == 'admin')
                <a href="{{ url('/admin/dashboard') }}"
                    class="bg-blue-600 text-white p-2 hover:cursor-pointer hover:bg-blue-500 rounded">Dashboard</a>
            @endif
        </div>

    </div>

</div>
