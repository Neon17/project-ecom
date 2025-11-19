@extends('components.layouts.guest')

@section('content')
    <!-- Elegant product showcase -->
    <div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50/30 py-12 px-4 sm:px-6 lg:px-8">
        <!-- Header section with elegant design -->
        <div class="max-w-7xl mx-auto text-center mb-16 fade-in">
            <div class="inline-flex items-center justify-center mb-4">
                <div class="w-3 h-3 bg-emerald-400 rounded-full mr-3"></div>
                <span class="text-sm font-medium text-emerald-600 uppercase tracking-wider">Premium Collection</span>
                <div class="w-3 h-3 bg-emerald-400 rounded-full ml-3"></div>
            </div>
            <h1 class="elegant-heading text-5xl md:text-6xl font-bold text-gray-900 mb-6 leading-tight">
                Discover Our <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 to-blue-600">Amazing</span> Products
            </h1>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto leading-relaxed">
                Explore a carefully curated selection of high-quality items designed to elevate your everyday experience.
            </p>
        </div>

        <!-- Products grid with enhanced design -->
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @foreach ($products as $product)
                    <div class="product-card group bg-white rounded-2xl shadow-sm hover:shadow-2xl overflow-hidden border border-gray-100/80 relative">
                        <!-- Premium badge -->
                        <div class="absolute top-4 left-4 z-10">
                            <span class="bg-gradient-to-r from-amber-400 to-amber-500 text-white text-xs font-semibold px-3 py-1.5 rounded-full shadow-lg">
                                Premium
                            </span>
                        </div>
                        
                        <a href="{{ route('products.show', $product->id) }}" class="block overflow-hidden">
                            <div class="relative overflow-hidden">
                                <div class="aspect-w-3 aspect-h-4 bg-gray-100">
                                    <img src="{{ asset('storage/' . $product->image) }}" 
                                         alt="{{ $product->name }}" 
                                         class="product-image w-full h-64 object-cover object-center group-hover:scale-105">
                                </div>
                                <!-- Hover overlay -->
                                <div class="absolute inset-0 bg-black/0 group-hover:bg-black/5 transition-all duration-500 flex items-center justify-center">
                                    <div class="opacity-0 group-hover:opacity-100 transform translate-y-4 group-hover:translate-y-0 transition-all duration-500">
                                        <span class="bg-white/90 backdrop-blur-sm text-gray-900 px-6 py-3 rounded-full font-semibold text-sm shadow-lg">
                                            View Details
                                        </span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="p-6">
                                <div class="flex items-start justify-between mb-3">
                                    <h3 class="text-lg font-semibold text-gray-900 line-clamp-2 leading-tight group-hover:text-gray-700 transition-colors">
                                        {{ $product->name }}
                                    </h3>
                                </div>
                                
                                <div class="flex items-center justify-between mt-4">
                                    <p class="text-2xl font-bold price-tag">
                                        NPR {{ number_format($product->price / 100, 2) }}
                                    </p>
                                    <div class="flex items-center text-amber-400">
                                        <i class="fas fa-star text-sm"></i>
                                        <i class="fas fa-star text-sm"></i>
                                        <i class="fas fa-star text-sm"></i>
                                        <i class="fas fa-star text-sm"></i>
                                        <i class="fas fa-star-half-alt text-sm"></i>
                                    </div>
                                </div>
                                
                                <!-- Quick action button -->
                                <button class="w-full mt-4 bg-gradient-to-r from-gray-900 to-gray-700 hover:from-gray-800 hover:to-gray-600 text-white py-3 px-4 rounded-xl font-semibold transition-all duration-300 transform hover:scale-[1.02] active:scale-[0.98] shadow-lg hover:shadow-xl">
                                    <i class="fas fa-shopping-cart mr-2"></i>
                                    Add to Cart
                                </button>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>

            <!-- Empty state with elegant design -->
            @if ($products->count() === 0)
                <div class="empty-state text-center py-24 rounded-3xl shadow-inner mt-12 max-w-2xl mx-auto">
                    <div class="w-24 h-24 mx-auto mb-6 bg-gradient-to-br from-gray-200 to-gray-300 rounded-full flex items-center justify-center">
                        <i class="fas fa-box-open text-4xl text-gray-400"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-700 mb-3">No Products Available</h3>
                    <p class="text-gray-500 text-lg max-w-md mx-auto">
                        We're currently refreshing our collection with new amazing products. Please check back soon!
                    </p>
                    <button class="mt-6 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-semibold py-3 px-8 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg">
                        Notify Me When Available
                    </button>
                </div>
            @endif

            <!-- Decorative footer note -->
            <div class="text-center mt-16 pt-8 border-t border-gray-200/60">
                <p class="text-gray-400 text-sm">
                    Crafted with <i class="fas fa-heart text-red-400 mx-1"></i> and endless inspiration
                </p>
            </div>
        </div>
    </div>

    <style>
        .elegant-heading {
            font-family: 'Playfair Display', serif;
        }
        
        .product-card {
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            background: linear-gradient(to bottom, #ffffff 0%, #fcfcfc 100%);
        }
        
        .product-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
        }
        
        .product-image {
            transition: transform 0.7s ease;
        }
        
        .price-tag {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        .empty-state {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .fade-in {
            animation: fadeIn 0.8s ease-out forwards;
        }
        
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
@endsection