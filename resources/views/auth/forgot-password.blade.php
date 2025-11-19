@extends('components.layouts.guest')


@section('content')
    <div class="min-h-screen flex items-center justify-center bg-gray-100 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full bg-white rounded-xl shadow-2xl p-8 space-y-8 border border-gray-200">
            <div class="text-center">
                <h2 class="mt-6 text-4xl font-extrabold text-gray-900">
                    Forgot Your Password?
                </h2>
                <p class="mt-2 text-sm text-gray-600">
                    Enter your email address and we'll send you a reset link.
                </p>
            </div>

            <form class="mt-8 space-y-6" action="{{ url('/forgot-password') }}" method="POST">
                @csrf

                <!-- Email Input -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                    <input id="email" name="email" type="email" autocomplete="email" required
                        class="appearance-none relative block w-full px-4 py-3 border border-gray-300 rounded-md placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition duration-200"
                        placeholder="Enter your email address" value="{{ old('email') }}">
                    @error('email')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <button type="submit"
                        class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-lg font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-200 shadow-md">
                        Send Reset Link
                    </button>
                </div>

                <div class="text-center text-sm text-gray-600">
                    Remembered your password? <a href="{{ route('login') }}"
                        class="font-medium text-blue-600 hover:text-blue-500 transition duration-200">Sign in</a>
                </div>
            </form>
        </div>
    </div>
@endsection
