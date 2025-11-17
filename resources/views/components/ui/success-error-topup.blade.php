@if (session('success') || session('error'))
    <div id="flash-message"
        class="fixed top-4 z-75 right-4 w-96 bg-white rounded-lg shadow-lg p-4 border-l-4 {{ session('success') ? 'border-green-500' : 'border-red-500' }}">

        <div class="flex items-start gap-3">
            <!-- Icon -->
            <div class="flex-shrink-0">
                @if (session('success'))
                    <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                @else
                    <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                @endif
            </div>

            <div class="flex-1">
                <h3 class="font-semibold text-gray-900 {{ session('success') ? 'text-green-900' : 'text-red-900' }}">
                    {{ session('success') ? 'Success' : 'Error' }}
                </h3>
                <p class="text-sm text-gray-600 mt-1">
                    {{ session('success') ?? session('error') }}
                </p>
            </div>

            <button onclick="closeFlashMessage()" class="flex-shrink-0 text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    <script>
        function closeFlashMessage() {
            const flash = document.getElementById('flash-message');
            if (flash) {
                flash.style.opacity = '0';
                flash.style.transform = 'translateX(100%)';
                setTimeout(() => flash.remove(), 300);
            }
        }

        setTimeout(() => {
            closeFlashMessage();
        }, 5000);
    </script>
@endif
