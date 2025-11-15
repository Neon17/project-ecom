<x-layouts.admin>


    <div class="px-3 mb-3 submit-wrapper">
        <a type="submit" href="{{ route('admin.users.index') }}"
            class="p-3 text-blue-500 hover:text-blue-700 transition-all duration-300 hover:cursor-pointer">Back to
            Table</a>
    </div>

    <div class="heading-wrapper text-2xl p-3 ms-2">
        Add User
    </div>

    <form action="{{route('admin.users.store')}}" method="POST" class="max-w-3xl">
        @csrf

        <div class="m-3 p-3 flex flex-col">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" class="border p-2">
            @error('name')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="m-3 p-3 flex flex-col">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" class="border p-2">
            @error('email')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="m-3 p-3 flex flex-col">
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" class="border p-2">
            @error('password')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="m-3 p-3 flex flex-col">
            <label for="password_confirmation">Confirm Password:</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="border p-2">
        </div>

        <div class="m-3 p-3 flex flex-col">
            <select name="role" id="role" class="p-2 border">
                <option value="">Select Role</option>
                @foreach(enum_labels(\App\Enums\RoleEnum::class) as $value=>$label)
                    <option value="{{ $value }}">{{ $label }}</option>
                @endforeach
            </select>
            @error('role')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>


        <div class="mx-3 px-3 submit-wrapper">
            <button type="submit"
                class="p-3 bg-blue-500 text-white hover:bg-blue-700 transition-all duration-300 hover:cursor-pointer">Add</button>
        </div>
    </form>



</x-layouts.admin>
