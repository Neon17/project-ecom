<x-layouts.admin>


    <div class="max-w-3xl mx-auto py-8 px-4 sm:px-6 lg:px-8 bg-gray-100 min-h-screen rounded-lg shadow-md mt-8">
        <!-- Header and Back Button -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-8 flex justify-between items-center">
            <h1 class="text-3xl font-bold text-gray-900">Create New Category</h1>
            <a href="{{ route('admin.categories.index') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition-colors duration-200 font-medium">
                <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to Categories List
            </a>
        </div>

        <form action="{{route('admin.categories.store')}}" method="POST" class="bg-white rounded-lg shadow-md border border-gray-200 p-8 space-y-6">
            @csrf

            <h2 class="text-2xl font-semibold text-gray-800 mb-6 pb-4 border-b border-gray-200">Category Details</h2>

            <x-ui.input-form name="name" required/>

            <div class="flex justify-end pt-4">
                <button type="submit"
                    class="px-8 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-300 font-semibold text-lg shadow-lg">
                    Add Category
                </button>
            </div>
        </form>
    </div>


</x-layouts.admin>
