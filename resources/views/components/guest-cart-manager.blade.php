@props(['user' => null])

<div x-data="guestCartManager({{ $user ? 'true' : 'false' }})" 
     x-init="initCart()"
     @add-to-cart-guest.window="addToCart($event.detail)"
     class="relative z-50">

    <!-- Import Modal -->
    <div x-show="showImportModal" 
         style="display: none;"
         class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center">
        <div class="bg-white dark:bg-slate-800 rounded-lg p-6 max-w-md w-full shadow-xl">
            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Import Cart?</h3>
            <p class="text-gray-600 dark:text-gray-300 mb-6">
                We found items in your guest cart. Would you like to merge them with your account's cart?
            </p>
            <div class="flex justify-end gap-4">
                <button @click="clearGuestCart()" 
                        class="px-4 py-2 text-gray-600 dark:text-gray-300 hover:text-gray-800 dark:hover:text-white">
                    No, Clear it
                </button>
                <button @click="importCart()" 
                        class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Yes, Import
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('guestCartManager', (isLoggedIn) => ({
            cart: [],
            showImportModal: false,
            isLoggedIn: isLoggedIn,

            initCart() {
                this.cart = JSON.parse(localStorage.getItem('guest_cart') || '[]');
                this.updateCount();

                if (this.isLoggedIn && this.cart.length > 0) {
                    this.showImportModal = true;
                }
            },

            addToCart(item) {
                // item: { id, name, price, image, quantity, max_quantity }
                let existing = this.cart.find(i => i.id === item.id);
                if (existing) {
                    if (existing.quantity + item.quantity <= item.max_quantity) {
                        existing.quantity += item.quantity;
                    } else {
                        alert('Max quantity reached for this item.');
                        return;
                    }
                } else {
                    this.cart.push(item);
                }
                this.saveCart();
                this.notify('Added to cart');
            },

            saveCart() {
                localStorage.setItem('guest_cart', JSON.stringify(this.cart));
                this.updateCount();
            },

            updateCount() {
                let count = this.cart.reduce((sum, item) => sum + parseInt(item.quantity), 0);
                // Dispatch event for navbar to pick up
                window.dispatchEvent(new CustomEvent('cart-count-updated', { detail: count }));
            },

            clearGuestCart() {
                localStorage.removeItem('guest_cart');
                this.cart = [];
                this.showImportModal = false;
                this.updateCount();
            },

            importCart() {
                fetch('{{ route("user.cart.merge") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ cart: this.cart })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        this.clearGuestCart();
                        window.location.reload(); // Reload to show updated DB cart
                    }
                });
            },

            notify(message) {
                // Simple alert or toast dispatch
                // Assuming a global toast listener exists or just alert for now
                // alert(message); 
                // Better: dispatch to existing notification system if any
                window.dispatchEvent(new CustomEvent('notify', { 
                    detail: { message: message, type: 'success' } 
                }));
            }
        }));
    });
</script>
