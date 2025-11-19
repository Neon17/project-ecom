const cartModal = document.getElementById('user-cart-modal');
const closeCartModal = document.getElementById('close-user-cart-modal');
const openCartModal = document.getElementById('open-user-cart-modal');

function openModal() {
    cartModal.classList.remove('hidden');
    // Trigger transition by adding data-state after a short delay
    setTimeout(() => {
        cartModal.setAttribute('data-state', 'open');
    }, 10);
}

function closeModal() {
    cartModal.setAttribute('data-state', 'closed');
    // Hide the modal after the transition completes
    cartModal.addEventListener('transitionend', function handler() {
        cartModal.classList.add('hidden');
        cartModal.removeEventListener('transitionend', handler);
    }, { once: true });
}

openCartModal.addEventListener('click', openModal);

closeCartModal.addEventListener('click', closeModal);

// Close when clicking outside the modal content
cartModal.addEventListener('click', function (e) {
    if (e.target === cartModal) {
        closeModal();
    }
});

window.addEventListener('keydown', function (e) {
    if (e.key === 'Escape' && !cartModal.classList.contains('hidden')) {
        closeModal();
    }
});