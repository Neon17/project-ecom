@extends('components.layouts.guest')


@section('content')
    <div class="p-3 rounded bg-gray-200 max-w-3xl mx-auto my-5">

        <div class="form-heading py-3 px-1 my-3">
            <h2 class="text-2xl bold">
                Send Forgot Password Email
            </h2>
        </div>


        <form action="{{ url('/forgot-password') }}" method="POST">
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


            <div class="button-wrapper py-3 px-1">
                <button type="submit"
                    class="bg-blue-600 text-white p-2 hover:cursor-pointer hover:bg-blue-500 rounded">Send Reset Password Link</button>
            </div>

        </form>

    </div>
@endsection
