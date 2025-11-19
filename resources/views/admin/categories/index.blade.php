<x-layouts.admin>

    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-900">Categories Management</h1>
            <a href="{{ route('admin.categories.create') }}"
                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors duration-300 flex items-center space-x-2">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                <span>Add New Category</span>
            </a>
        </div>

        @if ($categories->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr class="bg-gray-100 border-b border-gray-200">
                            <th
                                class="px-5 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                SN</th>
                            <th
                                class="px-5 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Name</th>
                            <th
                                class="px-5 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Slug</th>
                            <th
                                class="px-5 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($categories as $category)
                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                <td class="px-5 py-5 text-sm text-gray-800">{{ $loop->iteration }}</td>
                                <td class="px-5 py-5 text-sm text-gray-800">{{ $category->name }}</td>
                                <td class="px-5 py-5 text-sm text-gray-800">{{ $category->slug }}</td>
                                <td class="px-5 py-5 text-sm text-gray-800">
                                    <div class="flex items-center space-x-3">
                                        <a href="{{ route('admin.categories.edit', $category->id) }}"
                                            class="text-blue-600 hover:text-blue-900 transition-colors duration-200">
                                            Edit
                                        </a>
                                        <button
                                            class="open-delete-modal text-red-600 hover:text-red-900 transition-colors duration-200">
                                            View
                                        </button>
                                        <x-ui.delete-modal
                                            action="{{ route('admin.categories.destroy', $category->id) }}" />
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-center text-xl text-gray-500 py-10 bg-gray-50 rounded-lg">No categories found.</p>
        @endif
    </div>


</x-layouts.admin>
