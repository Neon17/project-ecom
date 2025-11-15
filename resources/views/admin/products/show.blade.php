<x-layouts.admin>


    <div class="px-3 mb-3 submit-wrapper">
        <a type="submit" href="{{ route('admin.products.index') }}"
            class="p-3 text-blue-500 hover:text-blue-700 transition-all duration-300 hover:cursor-pointer">Back to
            Table</a>
    </div>

    <div class="heading-wrapper text-2xl p-3 ms-2">
        View Product
    </div>

    <form action="{{ route('admin.products.update', $product->id) }}" method="post" class="max-w-3xl">
        @csrf
        @method('PUT')

        <x-ui.input-form name="name" value="{{ $product->name }}" readonly/>
        <div class="m-3 p-3 flex flex-col">
            <label for="description">Description:</label>
            <textarea type="text" name="description" id="description" class="border p-2" required readonly>
                {{ $product->description }}
            </textarea>
        </div>
        <x-ui.input-form name="price" label="Price Per Item (in paisa not rupees)" value="{{ $product->price }}" readonly />
        <x-ui.input-form name="quantity" type="number" min="0" value="{{ $product->quantity }}" readonly/>
        <x-ui.input-form name="slug" value="{{ $product->slug }}" readonly/>


        <div class="m-3 p-3 flex flex-col">
            <label for="categories-form-select">Categories:</label>
            <select class="border p-2" name="categories" id="categories-form-select" multiple readonly>
                <option value="1" class="inline p-1 m-1 bg-amber-100">Gadget</option>
                <option value="2" class="inline p-1 m-1 bg-amber-100">Electronics</option>
            </select>
            <p class="text-sm">(Press Ctrl + Click to select multiple categories)</p>
        </div>

        <div class="mx-3 px-3 submit-wrapper">
            <a href="{{route('admin.products.edit', $product->id)}}"
                class="p-3 bg-yellow-500 text-white hover:bg-yellow-700 transition-all duration-300 hover:cursor-pointer">Edit</a>
        </div>
    </form>



</x-layouts.admin>
