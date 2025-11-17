<x-layouts.admin>

    <div class="flex justify-between">
        
        <div class="title text-2xl p-3">
            Categories
        </div>
    
        <div class="button-wrapper py-3">
            <a href="{{ route('admin.categories.create') }}"
                class="p-3 bg-blue-500 text-white inline m-3 hover:bg-blue-800 transition-all duration-300">Add Category</a>
        </div>

    </div>


    @if ($categories->count() > 0)
        <table class="min-w-full my-5">
            <thead class="bg-gray-200">
                <tr>
                    <th class="w-1/4 py-2">SN</th>
                    <th class="w-1/4 py-2">Name</th>
                    <th class="w-1/4 py-2">Slug</th>
                    <th class="w-1/4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-300">
                @foreach ($categories as $category)
                    <tr class="table-row hover:bg-gray-50 transition-colors">
                        <td class="text-center p-2 px-5">{{$loop->iteration}}</td>
                        <td class="text-center p-2 px-5">{{ $category->name }}</td>
                        <td class="text-center p-2 px-5">{{ $category->slug }}</td>
                        <td class="text-center p-2 px-5 flex justify-center">
                            <a href="{{ route('admin.categories.edit', $category->id) }}"
                                class="p-2 bg-yellow-500 text-white mx-2 rounded hover:bg-yellow-700 transition-all duration-300">Edit</a>
                            <button
                                class="open-delete-modal p-2 bg-red-500 text-white mx-2 rounded hover:bg-red-700 duration-300 transaction-all">Delete</button>
                            <x-ui.delete-modal action="{{ route('admin.categories.destroy', $category->id) }}" />
                        </td>
                    </tr>
                @endforeach

            </tbody>

        </table>
    @else
        <div class="p-3 text-center pt-5 mt-5">
            <p>No categories found</p>
        </div>
    @endif



</x-layouts.admin>
