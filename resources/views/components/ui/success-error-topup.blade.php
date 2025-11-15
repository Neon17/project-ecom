@if (session('success') || session('error'))
    <div class="success-error-topup text-center fixed top-0 left-1/3 w-1/3 p-3 bg-green-100">
        <div class="{{ session('success') ? 'text-green-600' : 'text-red-600' }} text-lg">
            <p class="border-b inline mx-auto px-3">
                {{ session('success') ? 'Success' : 'Error' }}
            </p>
        </div>
        <p class="description my-3">
            {{ session('success') ? session('success') : session('error') }}
        </p>
    </div>
@endif
