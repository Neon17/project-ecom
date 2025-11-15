@if (session('success') || session('error'))
    <div id="top-flash-message" class="success-error-topup text-center fixed top-0 left-1/3 w-1/3 p-3 bg-green-100">
        <div class="{{ session('success') ? 'text-green-600' : 'text-red-600' }} text-lg">
            <p class="border-b inline mx-auto px-3">
                {{ session('success') ? 'Success' : 'Error' }}
            </p>
        </div>
        <p class="description my-3">
            {{ session('success') ? session('success') : session('error') }}
        </p>
    </div>

    @php
        $script = "
            <script>
                setTimeout(() => {
                    const flashMessage = document.getElementById('top-flash-message');
                    if (flashMessage) {
                        flashMessage.style.transition = 'all 0.5s ease';
                        flashMessage.style.opacity = '0';
                        flashMessage.style.transform = 'translateY(-100%)';
                        setTimeout(() => flashMessage.remove(), 500);
                    }
                }, 5000);
            </script>
        ";

    @endphp
@endif
