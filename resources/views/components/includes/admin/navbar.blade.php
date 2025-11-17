<nav class="bg-white shadow-md sticky top-0 z-50">
    <div class="mx-auto px-12 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            
            <div class="flex items-center space-x-8">
                <a href="{{ route('welcome') }}" class="text-xl font-bold text-gray-800 hover:text-blue-600 transition-colors">
                    Ecommerce
                </a>
                
                <a href="{{ route('products.index') }}" 
                   class="text-gray-600 hover:text-blue-600 transition-colors font-medium">
                    Products
                </a>
            </div>

            <div class="flex items-center space-x-4">
                @guest
                    <a href="{{ url('/login') }}" 
                       class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition-colors font-medium">
                        Login
                    </a>
                    <a href="{{ url('/register') }}" 
                       class="bg-gray-200 text-gray-800 px-4 py-2 rounded-md hover:bg-gray-300 transition-colors font-medium">
                        Register
                    </a>
                @else
                    <a href="{{ url('/admin/dashboard') }}" 
                       class="text-gray-600 hover:text-blue-600 transition-colors font-medium">
                        Dashboard
                    </a>
                    
                    <button id="open-user-cart-modal"
                            class="text-gray-600 hover:text-blue-600 transition-colors font-medium">
                        Cart
                    </button>
                    
                    <form action="{{ url('/logout') }}" method="POST" class="m-0">
                        @csrf
                        <button type="submit" 
                                class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700 transition-colors font-medium">
                            Logout
                        </button>
                    </form>
                @endguest
            </div>
        </div>
    </div>
</nav>