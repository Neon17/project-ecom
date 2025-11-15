<x-layouts.admin>

    <div class="title text-2xl p-3">
        Products
    </div>

    <div class="button-wrapper py-3">
        <a href="{{ route('admin.products.create') }}"
            class="p-3 bg-blue-500 text-white inline m-3 hover:bg-blue-800 transition-all duration-300">Add Products</a>
    </div>

    @if ($products->count() > 0)
        <table class="table-fixed border-separate p-3 w-3/4 my-10">
            <thead class="bg-gray-200">
                <tr>
                    <th class="w-1/6 border-r py-2">SN</th>
                    <th class="w-1/6 border-r py-2">Name</th>
                    <th class="w-1/6 border-r py-2">Price</th>
                    <th class="w-1/6 border-r py-2">Quantity</th>
                    <th class="w-1/6 border-r py-2">Description</th>
                    <th class="w-1/6 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td class="text-center p-2 px-5 border-r">1</td>
                        <td class="text-center p-2 px-5 border-r">{{ $product->name }}</td>
                        <td class="text-center p-2 px-5 border-r">{{ $product->price }}</td>
                        <td class="text-center p-2 px-5 border-r">{{ $product->quantity }}</td>
                        <td class="text-center p-2 px-5 border-r">{{ substr($product->description, 0, 20) }}</td>
                        <td class="text-center p-2 px-5 flex justify-center">
                            <a href="{{ route('admin.products.edit', $product->id) }}"
                                class="p-2 bg-yellow-500 text-white mx-2 rounded hover:bg-yellow-700 transition-all duration-300">Edit</a>
                            <a href="{{ route('admin.products.show', $product->id) }}"
                                class="p-2 bg-yellow-500 text-white mx-2 rounded hover:bg-yellow-700 transition-all duration-300">View</a>
                            <button
                                class="open-delete-modal p-2 bg-red-500 text-white mx-2 rounded hover:bg-red-700 duration-300 transaction-all">Delete</button>
                            <x-ui.delete-modal action="{{ route('admin.products.destroy', $product->id) }}" />
                        </td>
                    </tr>
                @endforeach

            </tbody>

        </table>
    @else
        <div class="p-3 text-center pt-5 mt-5">
            <p>No products found</p>
        </div>
    @endif



</x-layouts.admin>
