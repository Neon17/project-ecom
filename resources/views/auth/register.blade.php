@extends('components.layouts.guest')


@section('content')
    <div class="p-6 rounded bg-gray-50 shadow-lg max-w-xl mx-auto my-5">

        <div class="form-heading pt-3 pb-8 px-1 my-3 mb-5">
            <h2 class="text-2xl bold text-center">
                Welcome to our app!
            </h2>
        </div>


        <form action="{{ url('/register') }}" method="POST">
            @csrf

            <div class="form-group p-1 flex flex-col">
                <label for="name">Name:</label>
                <input type="name" class="border p-2" id="name" name="name" required />
                <div class="min-h-6">
                    @error('name')
                        <span class="text-red-300 dark:text-red-700 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>


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

            <div class="form-group p-1 flex flex-col">
                <label for="password_confirmation">Confirm Password: </label>
                <input type="password" class="border p-2" id="password_confirmation" name="password_confirmation"
                    required />
            </div>

            <div class="button-wrapper pb-3 pt-5 px-1">
                <button type="submit"
                    class="bg-blue-600 text-white p-2 hover:cursor-pointer hover:bg-blue-500 rounded">Register</button>
            </div>

        </form>

    </div>
@endsection
