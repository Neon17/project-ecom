var cartModal = document.getElementById('user-cart-modal');
var closeCartModal = document.getElementById('close-user-cart-modal');
var openCartModal = document.getElementById('open-user-cart-modal');

openCartModal.addEventListener('click', function () {
    cartModal.classList.remove('hidden');
});

closeCartModal.addEventListener('click', function () {
    cartModal.classList.add('hidden');
});

window.addEventListener('click', function (e) {
    if (e.target == cartModal) {
        cartModal.classList.add('hidden');
    }
});

window.addEventListener('keydown', function (e) {
    if (e.key == 'Escape') {
        cartModal.classList.add('hidden');
    }
});

cartModal.addEventListener('click', function (e) {
    if (e.target == cartModal) {
        cartModal.classList.add('hidden');
    }
});