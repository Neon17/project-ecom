@extends('components.layouts.guest')

@section('content')
    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-blue-900 via-blue-800 to-indigo-900 text-white py-20">
        <div class="absolute inset-0 bg-black opacity-20"></div>
        <div class="container mx-auto px-4 relative z-10">
            <div class="flex flex-col lg:flex-row items-center gap-12">
                <div class="lg:w-1/2 text-center lg:text-left">
                    <h1 class="text-5xl lg:text-6xl font-extrabold mb-6 leading-tight">
                        Welcome to Our Store
                    </h1>
                    <p class="text-xl lg:text-2xl text-blue-100 mb-8 leading-relaxed">
                        Discover amazing products across multiple categories. Quality you can trust, prices you'll love.
                    </p>
                    <div class="flex flex-wrap gap-4 justify-center lg:justify-start">
                        <a href="{{ route('products.index') }}"
                            class="bg-white text-blue-900 hover:bg-blue-50 font-bold px-8 py-4 rounded-lg transition duration-300 shadow-lg transform hover:scale-105">
                            <i class="fas fa-shopping-bag mr-2"></i>
                            Browse All Products
                        </a>
                        <a href="#categories"
                            class="bg-blue-700 hover:bg-blue-600 text-white font-bold px-8 py-4 rounded-lg transition duration-300 border-2 border-white">
                            <i class="fas fa-list mr-2"></i>
                            Shop by Category
                        </a>
                    </div>
                    <div class="mt-8 flex items-center justify-center lg:justify-start gap-6 text-blue-100">
                        <div class="flex items-center">
                            <i class="fas fa-shipping-fast text-2xl mr-2"></i>
                            <span>Free Shipping</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-shield-alt text-2xl mr-2"></i>
                            <span>Secure Payment</span>
                        </div>
                    </div>
                </div>
                <div class="lg:w-1/2 flex justify-center">
                    <div class="relative">
                        <img src="https://images.unsplash.com/photo-1607082348824-0a96f2a4b9da?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                            alt="Shopping" 
                            class="rounded-2xl shadow-2xl transform hover:scale-105 transition duration-500 max-w-md">
                        <div class="absolute -bottom-6 -right-6 bg-yellow-400 text-gray-900 px-6 py-3 rounded-lg shadow-lg font-bold text-lg">
                            <i class="fas fa-tag mr-2"></i> Special Offers!
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <section id="categories" class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-4">Shop by Category</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Browse our diverse collection of products organized by category
                </p>
            </div>

            @if($categories->count() > 0)
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 gap-6">
                    @foreach($categories as $category)
                        <a href="{{ route('welcome', ['category' => $category->id]) }}#categories"
                            class="group bg-white rounded-xl p-6 shadow-md hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 text-center {{ $selectedCategory && $selectedCategory->id == $category->id ? 'ring-4 ring-blue-500 bg-blue-50' : '' }}">
                            <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center group-hover:scale-110 transition duration-300">
                                <i class="fas fa-box text-white text-2xl"></i>
                            </div>
                            <h3 class="font-bold text-gray-900 mb-2">{{ $category->name }}</h3>
                            <p class="text-sm text-gray-500">{{ $category->products_count }} {{ Str::plural('product', $category->products_count) }}</p>
                        </a>
                    @endforeach
                </div>

                @if($selectedCategory)
                    <div class="mt-6 text-center">
                        <a href="{{ route('welcome') }}#categories" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-semibold">
                            <i class="fas fa-times mr-2"></i>
                            Clear filter (Showing: {{ $selectedCategory->name }})
                        </a>
                    </div>
                @endif
            @else
                <div class="text-center py-12">
                    <i class="fas fa-box-open text-6xl text-gray-300 mb-4"></i>
                    <p class="text-gray-500 text-lg">No categories available yet.</p>
                </div>
            @endif
        </div>
    </section>

    <!-- Products Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="flex flex-col lg:flex-row justify-between items-center mb-12">
                <div class="mb-6 lg:mb-0">
                    <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-3">
                        {{ $selectedCategory ? $selectedCategory->name . ' Products' : 'Featured Products' }}
                    </h2>
                    <p class="text-xl text-gray-600">
                        {{ $products->count() }} {{ Str::plural('product', $products->count()) }} available
                    </p>
                </div>
                <a href="{{ route('products.index') }}"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-6 py-3 rounded-lg transition duration-300 flex items-center shadow-lg">
                    View All Products <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>

            @if($products->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                    @foreach($products as $product)
                        <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 overflow-hidden group border border-gray-100">
                            <div class="relative overflow-hidden">
                                <a href="{{ route('products.show', $product->id) }}">
                                    <img src="{{ $product->image_url }}" 
                                        alt="{{ $product->name }}"
                                        class="w-full h-56 object-cover group-hover:scale-110 transition duration-500">
                                </a>
                                @if($product->quantity > 0)
                                    <div class="absolute top-3 right-3">
                                        <span class="bg-green-500 text-white px-3 py-1 rounded-full text-xs font-bold shadow-lg">
                                            In Stock
                                        </span>
                                    </div>
                                @else
                                    <div class="absolute top-3 right-3">
                                        <span class="bg-red-500 text-white px-3 py-1 rounded-full text-xs font-bold shadow-lg">
                                            Out of Stock
                                        </span>
                                    </div>
                                @endif
                            </div>
                            
                            <div class="p-5">
                                <a href="{{ route('products.show', $product->id) }}">
                                    <h3 class="font-bold text-gray-900 text-lg mb-2 line-clamp-2 hover:text-blue-600 transition">
                                        {{ $product->name }}
                                    </h3>
                                </a>
                                
                                <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                                    {{ Str::limit($product->description, 80) }}
                                </p>

                                @if($product->categories->count() > 0)
                                    <div class="flex flex-wrap gap-1 mb-4">
                                        @foreach($product->categories->take(2) as $cat)
                                            <span class="text-xs bg-blue-100 text-blue-700 px-2 py-1 rounded">
                                                {{ $cat->name }}
                                            </span>
                                        @endforeach
                                    </div>
                                @endif

                                <div class="flex justify-between items-center">
                                    <div class="text-2xl font-bold text-blue-600">
                                        NPR {{ number_format($product->price / 100, 2) }}
                                    </div>
                                    
                                    @auth
                                        @if($product->quantity > 0)
                                            <form action="{{ route('user.cart.store') }}" method="POST" class="inline">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                <input type="hidden" name="quantity" value="1">
                                                <button type="submit"
                                                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition duration-300 flex items-center text-sm font-semibold shadow-md">
                                                    <i class="fas fa-cart-plus mr-1"></i>
                                                    Add
                                                </button>
                                            </form>
                                        @else
                                            <button disabled
                                                class="bg-gray-300 text-gray-500 px-4 py-2 rounded-lg cursor-not-allowed text-sm font-semibold">
                                                <i class="fas fa-ban mr-1"></i>
                                                Unavailable
                                            </button>
                                        @endif
                                    @else
                                        <a href="{{ route('login') }}"
                                            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition duration-300 text-sm font-semibold shadow-md">
                                            <i class="fas fa-sign-in-alt mr-1"></i>
                                            Login
                                        </a>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-16 bg-gray-50 rounded-2xl">
                    <i class="fas fa-shopping-basket text-6xl text-gray-300 mb-4"></i>
                    <h3 class="text-2xl font-bold text-gray-700 mb-2">No Products Found</h3>
                    <p class="text-gray-500 mb-6">
                        {{ $selectedCategory ? 'No products available in this category.' : 'No products available at the moment.' }}
                    </p>
                    @if($selectedCategory)
                        <a href="{{ route('welcome') }}" class="text-blue-600 hover:text-blue-800 font-semibold">
                            Browse all products
                        </a>
                    @endif
                </div>
            @endif
        </div>
    </section>

    <!-- Why Choose Us -->
    <section class="py-16 bg-gradient-to-r from-blue-800 to-indigo-900 text-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold mb-4">Why Shop With Us?</h2>
                <p class="text-xl text-blue-100">Your satisfaction is our priority</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="text-center p-6">
                    <div class="w-20 h-20 mx-auto mb-4 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                        <i class="fas fa-shipping-fast text-4xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Free Shipping</h3>
                    <p class="text-blue-100">On all orders across Nepal</p>
                </div>
                
                <div class="text-center p-6">
                    <div class="w-20 h-20 mx-auto mb-4 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                        <i class="fas fa-shield-alt text-4xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Secure Payment</h3>
                    <p class="text-blue-100">100% secure transactions</p>
                </div>
                
                <div class="text-center p-6">
                    <div class="w-20 h-20 mx-auto mb-4 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                        <i class="fas fa-undo text-4xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Easy Returns</h3>
                    <p class="text-blue-100">7-day return policy</p>
                </div>
                
                <div class="text-center p-6">
                    <div class="w-20 h-20 mx-auto mb-4 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                        <i class="fas fa-headset text-4xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2">24/7 Support</h3>
                    <p class="text-blue-100">Always here to help</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl mx-auto text-center bg-gradient-to-r from-blue-50 to-indigo-50 rounded-2xl p-12 shadow-lg">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Stay Updated!</h2>
                <p class="text-xl text-gray-600 mb-8">
                    Subscribe to get special offers, product updates, and exclusive deals.
                </p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <input type="email" placeholder="Enter your email"
                        class="flex-grow px-6 py-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-lg">
                    <button
                        class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-8 py-4 rounded-lg transition duration-300 whitespace-nowrap shadow-lg">
                        <i class="fas fa-envelope mr-2"></i>
                        Subscribe
                    </button>
                </div>
                <p class="text-gray-500 text-sm mt-4">We respect your privacy. Unsubscribe anytime.</p>
            </div>
        </div>
    </section>
@endsection
