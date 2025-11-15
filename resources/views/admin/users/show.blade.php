<x-layouts.admin>


    <div class="px-3 mb-3 submit-wrapper">
        <a type="submit" href="{{ route('admin.users.index') }}"
            class="p-3 text-blue-500 hover:text-blue-700 transition-all duration-300 hover:cursor-pointer">Back to
            Table</a>
    </div>

    <div class="heading-wrapper text-2xl p-3 ms-2">
        User Details
    </div>

    <form action="#" method="get" class="max-w-3xl">
        @csrf

        <div class="m-3 p-3 flex flex-col">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" value="{{ $user->name }}" class="border p-2" readonly>
        </div>

        <div class="m-3 p-3 flex flex-col">
            <label for="slug">Email:</label>
            <input type="text" name="slug" id="slug" value={{ $user->email }} class="border p-2" readonly>
        </div>


        <div class="m-3 p-3 flex flex-col">
            <label for="slug">Role:</label>
            <input type="text" name="slug" id="slug" value={{ $user->role }} class="border p-2" readonly>
        </div>
    </form>

    <div class="title text-2xl p-3">
        Addresses
    </div>

    {{-- Table Design --}}
    <table class="table-fixed border-separate p-3 w-3/4 my-10 mx-3">
        <thead class="bg-gray-200">
            <tr>
                <th class="w-1/6 border-r py-2">SN</th>
                <th class="w-1/6 border-r py-2">Country</th>
                <th class="w-1/6 border-r py-2">City</th>
                <th class="w-1/6 border-r py-2">State</th>
                <th class="w-1/6 border-r py-2">User</th>
                <th class="w-1/6 py-2">Street Address 1</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="text-center p-2 px-5 border-r">1</td>
                <td class="text-center p-2 px-5 border-r">Nepal</td>
                <td class="text-center p-2 px-5 border-r">Hemja</td>
                <td class="text-center p-2 px-5 border-r">4</td>
                <td class="text-center p-2 px-5 border-r">Shyam Gautam</td>
                <td class="text-center p-2 px-5 flex justify-center">
                    Street 2
                </td>
            </tr>
            <tr>
                <td class="text-center p-2 px-5 border-r">2</td>
                <td class="text-center p-2 px-5 border-r">Nepal</td>
                <td class="text-center p-2 px-5 border-r">Tudikhel</td>
                <td class="text-center p-2 px-5 border-r">3</td>
                <td class="text-center p-2 px-5 border-r">Ramesh Pandey</td>
                <td class="text-center p-2 px-5 flex justify-center">
                    Street 3
                </td>
            </tr>

        </tbody>

    </table>


</x-layouts.admin>
