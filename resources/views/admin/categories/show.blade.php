<x-layouts.admin>


    <div class="px-3 mb-3 submit-wrapper">
        <a type="submit" href="{{ route('admin.categories.index') }}"
            class="p-3 text-blue-500 hover:text-blue-700 transition-all duration-300 hover:cursor-pointer">Back to
            Table</a>
    </div>

    <div class="heading-wrapper text-2xl p-3 ms-2">
        Category Details
    </div>

    @if ($category)
        <form action="#" method="get" class="max-w-3xl">

            <div class="m-3 p-3 flex flex-col">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" readonly value="{{ $category->name }}"
                    class="border p-2">
            </div>

            <div class="m-3 p-3 flex flex-col">
                <label for="slug">Slug:</label>
                <input type="text" name="slug" id="slug" readonly value="{{ $category->slug }}"
                    class="border p-2">
            </div>
            <div class="mx-3 px-3 submit-wrapper">
                <a href="{{ route('admin.categories.edit', $category->id) }}"
                    class="p-3 bg-yellow-500 text-white hover:bg-yellow-700 transition-all duration-300 hover:cursor-pointer">Edit</a>
            </div>

        </form>
    @else
        <div class="m-3 p-3 flex flex-col">
            <p>No category found</p>
        </div>
    @endif



</x-layouts.admin>
