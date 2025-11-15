<x-layouts.admin>


    <div class="px-3 mb-3 submit-wrapper">
        <a type="submit" href="{{ route('admin.products.index') }}"
            class="p-3 text-blue-500 hover:text-blue-700 transition-all duration-300 hover:cursor-pointer">Back to
            Table</a>
    </div>

    <div class="heading-wrapper text-2xl p-3 ms-2">
        Edit Product
    </div>

    <form action="{{ route('admin.products.update', $product->id) }}" method="post" class="max-w-3xl">
        @csrf
        @method('PUT')

        <x-ui.input-form name="name" value="{{ $product->name }}" />
        <div class="m-3 p-3 flex flex-col">
            <label for="description">Description:</label>
            <textarea type="text" name="description" id="description" class="border p-2" required>
                {{ $product->description }}
            </textarea>
        </div>
        <x-ui.input-form name="price" label="Price Per Item (in paisa not rupees)" value="{{ $product->price }}" />
        <x-ui.input-form name="quantity" type="number" min="0" value="{{ $product->quantity }}" />
        <x-ui.input-form name="slug" value="{{ $product->slug }}" />

        @if ($categories->count() > 0)
            <div class="m-3 p-3 flex flex-col">
                <label for="categories-form-select">Categories:</label>
                <select class="border p-2" name="categories[]" id="categories-form-select" multiple>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" class="inline p-1 m-1"
                            {{ $product->categories->contains($category->id) ? 'selected bg-amber-600 text-white' : '' }}    
                        >{{ $category->name }}
                        </option>
                    @endforeach
                </select>
                <p class="text-sm">(Press Ctrl + Click to select multiple categories)</p>
            </div>
        @endif

        <div class="mx-3 px-3 submit-wrapper">
            <button type="submit"
                class="p-3 bg-blue-500 text-white hover:bg-blue-700 transition-all duration-300 hover:cursor-pointer">Update</button>
        </div>
    </form>



</x-layouts.admin>
