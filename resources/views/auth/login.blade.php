@extends('components.layouts.guest')


@section('content')
    <div class="p-10 rounded bg-gray-50 shadow-lg max-w-xl mx-auto my-5">

        <div class="form-heading pb-6 px-1">
            <h2 class="text-2xl bold text-center">
                Welcome to our app!
            </h2>
        </div>


        <form action="{{ url('/login') }}" class="pt-6" method="POST">
            @csrf

            <div class="form-group p-1 flex flex-col">
                <label for="email">Email:</label>
                <input type="email" class="border p-2" id="email" name="email" required />
                <div class="min-h-6">
                    @error('email')
                        <span class="text-red-300 dark:text-red-700 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group p-1 flex flex-col">
                <label for="password">Password: </label>
                <input type="password" class="border p-2" id="password" name="password" required />
                <div class="min-h-6">
                    @error('password')
                        <span class="text-red-300 dark:text-red-700 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="button-wrapper py-3 px-1">
                <button type="submit"
                    class="bg-blue-600 text-white p-2 hover:cursor-pointer hover:bg-blue-500 rounded">Login</button>
                <a href="{{route('password.request')}}" class="text-blue-500 hover:text-blue-800 hover:cursor-pointer mx-3">
                    Forgot Password?
                </a>
            </div>

        </form>

    </div>
@endsection
