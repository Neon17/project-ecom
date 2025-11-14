@props(['action'=>null])

<div class="delete-model hidden fixed top-0 left-1/3 w-1/3 p-3 bg-green-100">
    <div class="text-red-600 text-lg">
        <p class="border-b inline mx-auto px-3">
            Are you sure want to delete?
        </p>
    </div>
    <p class="description my-3">
        The action cannot be undone.
    </p>
    <div class="action-wrapper flex justify-center">
        <button
            class="close-delete-model p-2 bg-gray-500 text-white mx-2 rounded transition-all duration-300 hover:bg-gray-700 hover:cursor-pointer">Cancel</button>
        <form action="{{ $action ?? '#' }}" method="post">
            @csrf
            @method('DELETE')
            <button
                class="p-2 bg-red-500 text-white mx-2 rounded transition-all duration-300 hover:bg-red-700 hover:cursor-pointer"
                type="submit">Delete</button>
        </form>
    </div>
</div>
