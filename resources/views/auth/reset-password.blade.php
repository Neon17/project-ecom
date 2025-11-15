@extends('components.layouts.guest')


@section('content')
    <div class="p-3 rounded bg-gray-200 max-w-3xl mx-auto my-5">

        <div class="form-heading py-3 px-1 my-3">
            <h2 class="text-2xl bold">
                Welcome to our app!
            </h2>
        </div>


        <form action="{{ url('/reset-password') }}" method="POST">
            @csrf

            <div class="hidden">
                hello
            </div>
            
            <input type="hidden" name="token" value="{{$token}}">
            <input type="hidden" name="email" value="{{$email}}">

            <div class="form-group p-1 flex flex-col">
                <label for="password">New Password: </label>
                <input type="password" class="border p-2" id="password" name="password" required />
                <div class="min-h-6">
                    @error('password')
                        <span class="text-red-300 dark:text-red-700 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group p-1 flex flex-col">
                <label for="password">Confirm New Password: </label>
                <input type="password" class="border p-2" id="password_confirmation" name="password_confirmation" required />
            </div>

            <div class="button-wrapper py-3 px-1">
                <button type="submit"
                    class="bg-blue-600 text-white p-2 hover:cursor-pointer hover:bg-blue-500 rounded">Reset Password</button>
            </div>

        </form>

    </div>
@endsection
