@extends('components.layouts.guest')

@section('content')
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-blue-50 to-indigo-50 py-12">
        <div class="container mx-auto px-4">
            <div class="flex flex-col lg:flex-row items-center min-h-[75vh]">
                <div class="lg:w-1/2 mb-8 lg:mb-0">
                    <h1 class="text-4xl lg:text-6xl font-bold text-gray-900 mb-6 leading-tight">
                        Discover Your Perfect Style
                    </h1>
                    <p class="text-lg lg:text-xl text-gray-600 mb-8 leading-relaxed">
                        Explore our carefully curated collection of premium products. From fashion essentials to
                        must-have accessories, we bring you quality and style in every purchase.
                    </p>
                    <div class="flex flex-wrap gap-4 mb-6">
                        <a href="{{ route('products.index') }}"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-8 py-4 rounded-lg transition duration-300 flex items-center">
                            <i class="fas fa-shopping-bag mr-3"></i>
                            Shop Now
                        </a>
                        <a href="#featured"
                            class="border-2 border-gray-800 hover:bg-gray-800 hover:text-white text-gray-800 font-semibold px-8 py-4 rounded-lg transition duration-300 flex items-center">
                            <i class="fas fa-star mr-3"></i>
                            Featured Items
                        </a>
                    </div>
                    <div class="flex items-center text-gray-500">
                        <i class="fas fa-shipping-fast mr-2"></i>
                        <span class="text-sm">Free shipping on orders over $50</span>
                    </div>
                </div>
                <div class="lg:w-1/2 flex justify-center">
                    <img src="https://images.unsplash.com/photo-1441986300917-64674bd600d8?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80"
                        alt="Fashion Collection"
                        class="rounded-2xl shadow-2xl w-full max-w-lg transform hover:scale-105 transition duration-500">
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Categories -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-4">Shop by Category</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">Find exactly what you're looking for in our diverse
                    categories</p>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                @php
                    $categories = [
                        ['name' => 'Men\'s Fashion', 'icon' => 'fa-tshirt', 'color' => 'blue'],
                        ['name' => 'Women\'s Fashion', 'icon' => 'fa-female', 'color' => 'pink'],
                        ['name' => 'Electronics', 'icon' => 'fa-laptop', 'color' => 'green'],
                        ['name' => 'Home & Living', 'icon' => 'fa-home', 'color' => 'purple'],
                    ];
                @endphp

                @foreach ($categories as $category)
                    <div class="group">
                        <div
                            class="bg-white border border-gray-200 rounded-xl p-6 text-center shadow-sm hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 h-full">
                            <div
                                class="w-16 h-16 mx-auto mb-4 rounded-full bg-{{ $category['color'] }}-100 flex items-center justify-center group-hover:bg-{{ $category['color'] }}-200 transition duration-300">
                                <i class="fas {{ $category['icon'] }} text-{{ $category['color'] }}-600 text-2xl"></i>
                            </div>
                            <h3 class="font-bold text-gray-900 text-lg mb-2">{{ $category['name'] }}</h3>
                            <p class="text-gray-500 text-sm">Explore collection</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Featured Products -->
    <section id="featured" class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="flex flex-col lg:flex-row justify-between items-center mb-12">
                <div class="mb-6 lg:mb-0">
                    <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-3">Featured Products</h2>
                    <p class="text-xl text-gray-600">Handpicked items just for you</p>
                </div>
                <a href="{{ route('products.index') }}"
                    class="border-2 border-blue-600 text-blue-600 hover:bg-blue-600 hover:text-white font-semibold px-6 py-3 rounded-lg transition duration-300 flex items-center">
                    View All <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @for ($i = 0; $i < 4; $i++)
                    <div
                        class="bg-white rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 overflow-hidden group">
                        <div class="relative overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80"
                                class="w-full h-48 object-cover group-hover:scale-110 transition duration-500"
                                alt="Product {{ $i + 1 }}">
                            <div class="absolute top-3 right-3">
                                <span class="bg-red-500 text-white px-3 py-1 rounded-full text-sm font-semibold">Hot</span>
                            </div>
                            <div
                                class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-10 transition duration-300">
                            </div>
                        </div>
                        <div class="p-6 flex flex-col h-48">
                            <h3 class="font-bold text-gray-900 text-lg mb-2">Premium Product {{ $i + 1 }}</h3>
                            <p class="text-gray-600 text-sm flex-grow mb-4">
                                High-quality product with excellent features and modern design perfect for everyday use.
                            </p>
                            <div class="flex justify-between items-center">
                                <span class="text-2xl font-bold text-blue-600">${{ rand(20, 100) }}.99</span>
                                <div class="flex space-x-2">
                                    <button
                                        class="w-10 h-10 rounded-full border border-gray-300 hover:border-gray-400 flex items-center justify-center transition duration-300 hover:bg-gray-50">
                                        <i class="far fa-heart text-gray-600"></i>
                                    </button>
                                    <button
                                        class="w-10 h-10 rounded-full bg-blue-600 hover:bg-blue-700 flex items-center justify-center transition duration-300 text-white add-to-cart">
                                        <i class="fas fa-shopping-cart"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </section>

    <!-- Shopping Stats -->
    <section class="py-16 bg-gradient-to-r from-blue-600 to-purple-700 text-white">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-8 text-center">
                <div class="p-6">
                    <div class="text-5xl lg:text-6xl font-bold mb-2">10K+</div>
                    <p class="text-blue-100 text-lg">Happy Customers</p>
                </div>
                <div class="p-6">
                    <div class="text-5xl lg:text-6xl font-bold mb-2">500+</div>
                    <p class="text-blue-100 text-lg">Products</p>
                </div>
                <div class="p-6">
                    <div class="text-5xl lg:text-6xl font-bold mb-2">50+</div>
                    <p class="text-blue-100 text-lg">Brands</p>
                </div>
                <div class="p-6">
                    <div class="text-5xl lg:text-6xl font-bold mb-2">24/7</div>
                    <p class="text-blue-100 text-lg">Support</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="max-w-2xl mx-auto text-center">
                <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-4">Stay Updated</h2>
                <p class="text-xl text-gray-600 mb-8">
                    Subscribe to get special offers, free giveaways, and exclusive deals.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 mb-4">
                    <input type="email" placeholder="Enter your email"
                        class="flex-grow px-6 py-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-lg">
                    <button
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-8 py-4 rounded-lg transition duration-300 whitespace-nowrap">
                        Subscribe
                    </button>
                </div>
                <p class="text-gray-500 text-sm">We respect your privacy. Unsubscribe at any time.</p>
            </div>
        </div>
    </section>

    <!-- Shopping Cart Toast Notification -->
    <div id="cart-toast"
        class="fixed top-4 right-4 bg-green-500 text-white px-6 py-4 rounded-lg shadow-lg transform translate-x-full transition-transform duration-300 z-50 hidden">
        <div class="flex items-center">
            <i class="fas fa-check-circle mr-3"></i>
            <span>Product added to cart successfully!</span>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add to cart functionality
            const addToCartButtons = document.querySelectorAll('.add-to-cart');
            const cartToast = document.getElementById('cart-toast');

            addToCartButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();

                    // Show toast notification
                    cartToast.classList.remove('hidden');
                    cartToast.classList.remove('translate-x-full');

                    // Hide toast after 3 seconds
                    setTimeout(() => {
                        cartToast.classList.add('translate-x-full');
                        setTimeout(() => cartToast.classList.add('hidden'), 300);
                    }, 3000);

                    // Update cart count (simulated)
                    updateCartCount();
                });
            });

            function updateCartCount() {
                // This would typically be an AJAX call to update the cart
                const cartCount = document.querySelector('.cart-count');
                if (cartCount) {
                    const currentCount = parseInt(cartCount.textContent) || 0;
                    cartCount.textContent = currentCount + 1;

                    // Add animation
                    cartCount.classList.add('scale-150');
                    setTimeout(() => cartCount.classList.remove('scale-150'), 300);
                }
            }

            // Smooth scroll for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });
        });
    </script>
@endsection
