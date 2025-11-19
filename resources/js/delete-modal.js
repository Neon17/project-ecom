var delete_modal = document.getElementsByClassName('delete-modal');
var close_delete_modal = document.getElementsByClassName('close-delete-modal');
var open_delete_modal = document.getElementsByClassName('open-delete-modal');

document.addEventListener('click', function(e) {
    // Open modal
    if (e.target.closest('.open-delete-modal')) {
        const modalToOpen = e.target.closest('.open-delete-modal').nextElementSibling; // Assuming modal is sibling
        if (modalToOpen && modalToOpen.classList.contains('delete-modal')) {
            modalToOpen.classList.remove('hidden');
            modalToOpen.setAttribute('data-state', 'open');
        }
    }

    // Close modal via close button or backdrop
    if (e.target.closest('.close-delete-modal') || (e.target.classList.contains('delete-modal') && e.target.getAttribute('data-state') === 'open')) {
        const modalToClose = e.target.closest('.delete-modal') || e.target;
        if (modalToClose) {
            modalToClose.classList.add('hidden');
            modalToClose.setAttribute('data-state', 'closed');
        }
    }
});

window.addEventListener('keydown', function (e) {
    if (e.key == 'Escape') {
        for (let i = 0; i < delete_modal.length; i++) {
            if (!delete_modal[i].classList.contains('hidden')) {
                delete_modal[i].classList.add('hidden');
                delete_modal[i].setAttribute('data-state', 'closed');
            }
        }
    }
});
