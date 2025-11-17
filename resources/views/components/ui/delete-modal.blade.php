@props(['action'=>null])

<div class="delete-modal hidden fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-96 bg-white rounded-lg shadow-lg p-6">
    <div class="mb-4">
        <h3 class="text-xl font-bold text-gray-800">
            Delete Confirmation
        </h3>
    </div>
    
    <p class="text-gray-600 mb-6">
        Are you sure you want to delete this? This action cannot be undone.
    </p>
    
    <div class="flex gap-3 justify-end">
        <button class="close-delete-modal px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">
            Cancel
        </button>
        
        <form action="{{ $action ?? '#' }}" method="post" class="inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                Delete
            </button>
        </form>
    </div>
</div>

<div class="delete-backdrop hidden fixed top-0 left-0 w-full h-full bg-black bg-opacity-50"></div>