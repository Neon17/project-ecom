<x-layouts.admin>


    <div class="px-3 mb-3 submit-wrapper">
        <a type="submit" href="{{route('admin.products.index')}}"
            class="p-3 text-blue-500 hover:text-blue-700 transition-all duration-300 hover:cursor-pointer">Back to Table</a>
    </div>

    <div class="heading-wrapper text-2xl p-3 ms-2">
        Edit Product
    </div>

    <form action="#" method="post" class="max-w-3xl">
        @csrf

        <div class="m-3 p-3 flex flex-col">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" class="border p-2">
        </div>

        <div class="m-3 p-3 flex flex-col">
            <label for="slug">Description:</label>
            <input type="text" name="slug" id="slug" class="border p-2">
        </div>

        <div class="m-3 p-3 flex flex-col">
            <label for="slug">Price:</label>
            <input type="text" name="slug" id="slug" class="border p-2">
        </div>

        <div class="m-3 p-3 flex flex-col">
            <label for="slug">Quantity:</label>
            <input type="text" name="slug" id="slug" class="border p-2">
        </div>

        <div class="m-3 p-3 flex flex-col">
            <label for="slug">Slug:</label>
            <input type="text" name="slug" id="slug" class="border p-2">
        </div>

        <div class="m-3 p-3 flex flex-col">
            <label for="categories-form-select">Categories:</label>
            <select class="border p-2" id="categories-form-select" multiple>
                <option value="1" class="inline p-1 m-1 bg-amber-100">Gadget</option>
                <option value="2" class="inline p-1 m-1 bg-amber-100">Electronics</option>
            </select>
            <p class="text-sm">(Press Ctrl + Click to select multiple categories)</p>
        </div>

        <div class="mx-3 px-3 submit-wrapper">
            <button type="submit"
                class="p-3 bg-blue-500 text-white hover:bg-blue-700 transition-all duration-300 hover:cursor-pointer">Update</button>
        </div>
    </form>



</x-layouts.admin>
