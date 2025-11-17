@extends('components.layouts.guest')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Our Products</h1>
            <p class="mt-2 text-gray-600">Discover our amazing collection</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach ($products as $product)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                    <a href="{{ route('products.show', $product->id) }}" class="block">
                        <div class="aspect-w-3 aspect-h-4">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                class="w-full h-48 object-cover">
                        </div>
                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2 line-clamp-2">
                                {{ $product->name }}
                            </h3>
                            <p class="text-xl font-bold text-green-600">
                                Rs. {{ number_format($product->price / 100, 2) }}
                            </p>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

        @if ($products->count() === 0)
            <div class="text-center py-12">
                <p class="text-gray-500 text-lg">No products available at the moment.</p>
            </div>
        @endif
    </div>
@endsection
