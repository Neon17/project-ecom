<x-layouts.admin>


    <div class="max-w-3xl mx-auto py-8 px-4 sm:px-6 lg:px-8 bg-gray-100 dark:bg-slate-800 min-h-screen rounded-lg shadow-md mt-8">
        <!-- Header and Back Button -->
        <div class="bg-white dark:bg-slate-900 rounded-lg shadow-md p-6 mb-8 flex justify-between items-center">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Category Details #{{ $category->id }}</h1>
            <a href="{{ route('admin.categories.index') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-slate-700 text-gray-700 dark:text-gray-300 dark:text-gray-600 rounded-md hover:bg-gray-300 transition-colors duration-200 font-medium">
                <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to Categories List
            </a>
        </div>

        @if ($category)
            <div class="bg-white dark:bg-slate-900 rounded-lg shadow-md border border-gray-200 dark:border-slate-700 p-8 space-y-6">
                <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-6 pb-4 border-b border-gray-200 dark:border-slate-700">Category Information</h2>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 dark:text-gray-600 mb-2">Name:</label>
                    <p class="w-full bg-gray-50 dark:bg-slate-800 border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-3 text-gray-800 dark:text-gray-200 font-medium cursor-not-allowed">
                        {{ $category->name }}
                    </p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 dark:text-gray-600 mb-2">Slug:</label>
                    <p class="w-full bg-gray-50 dark:bg-slate-800 border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-3 text-gray-800 dark:text-gray-200 font-medium cursor-not-allowed">
                        {{ $category->slug }}
                    </p>
                </div>

                <div class="flex justify-end pt-4">
                    <a href="{{ route('admin.categories.edit', $category->id) }}"
                        class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-300 font-semibold text-lg shadow-lg">
                        Edit Category
                    </a>
                </div>
            </div>
        @else
            <div class="p-8 text-center text-xl text-gray-500 dark:text-gray-400 dark:text-gray-500 bg-white dark:bg-slate-900 rounded-lg shadow-md">
                <p>No category found.</p>
            </div>
        @endif
    </div>


</x-layouts.admin>
