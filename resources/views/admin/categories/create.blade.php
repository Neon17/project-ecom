<x-layouts.admin>


    <div class="px-3 mb-3 submit-wrapper">
        <a type="submit" href="{{route('admin.categories.index')}}"
            class="p-3 text-blue-500 hover:text-blue-700 transition-all duration-300 hover:cursor-pointer">Back to Table</a>
    </div>

    <div class="heading-wrapper text-2xl p-3 ms-2">
        Add Category
    </div>

    <form action="#" method="post" class="max-w-3xl">
        @csrf

        <div class="m-3 p-3 flex flex-col">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" class="border p-2">
        </div>

        <div class="m-3 p-3 flex flex-col">
            <label for="slug">Slug:</label>
            <input type="text" name="slug" id="slug" class="border p-2">
        </div>

        <div class="mx-3 px-3 submit-wrapper">
            <button type="submit"
                class="p-3 bg-blue-500 text-white hover:bg-blue-700 transition-all duration-300 hover:cursor-pointer">Add</button>
        </div>
    </form>



</x-layouts.admin>
