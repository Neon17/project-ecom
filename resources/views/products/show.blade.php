@extends('components.layouts.guest')


@section('content')
    <div class="bg-gray-200 flex mx-auto max-w-xl p-10 shadow-md">

        <img src="{{ asset('storage/' . $product->image) }}" class="w-1/2 h-full fill p-3" alt="">

        <div class="text-wrapper-content">
            <p class="text-2xl py-5">
                {{ $product->name }}
            </p>

            <div class="product-description-wrapper py-3">
                <p class="text">
                    {{ $product->description }}
                </p>
            </div>

            @if ($product->categories->count() > 0)
                <div class="general-info-wrapper">
                    <p class="text">
                        Category:
                        @foreach ($product->categories as $category)
                            @if (!$loop->first) , @endif {{ $category->name }}
                        @endforeach
                    </p>
                </div>
            @endif
            <p class="text">
                Available Quantity: {{ $product->quantity }}
            </p>

            <p>
                Price: {{ $product->price/100 }} NPR
            </p>


            <div class="button-wrapper flex py-10">
                <button
                    class="p-2 bg-yellow-600 text-white mx-2 rounded hover:bg-yellow-700 transition-all duration-300">
                    Add to Cart
                </button>
                <button class="p-2 bg-blue-500 text-white mx-2 rounded hover:bg-blue-700 transition-all duration-300">
                    Buy Now
                </button>
            </div>
        </div>

    </div>
@endsection
