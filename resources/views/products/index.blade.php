@extends('components.layouts.guest')


@section('content')
    <div class="title-home py-10">
        <h2 class="text-2xl p-3 text-center">
            Products
        </h2>
    </div>

    <div class="p-3 flex gap-3 flex-wrap items-center justify-center">

        @foreach ($products as $product)
            <a href="{{ route('products.show', $product->id) }}" class="bg-gray-100 w-60 h-80 rounded shadow-lg flex flex-col items-center hover:cursor-pointer hover:bg-gray-200">
                <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-3/4 fill p-3" alt="">
                <div class="p-3">
                    <h2 class="text-lg text-center">{{ $product->name }}</h2>
                    <h2 class="text-lg text-center">{{ $product->price/100 }} NPR</h2>
                </div>
            </a>
        @endforeach

    </div>
@endsection
