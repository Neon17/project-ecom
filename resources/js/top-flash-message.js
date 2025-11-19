document.addEventListener('DOMContentLoaded', function() {
    const flashMessage = document.getElementById('top-flash-message');
    if (flashMessage) {
        // Add event listener to close button if it exists
        const closeButton = flashMessage.querySelector('.close-flash-message');
        if (closeButton) {
            closeButton.addEventListener('click', function() {
                dismissFlashMessage(flashMessage);
            });
        }

        // Auto-dismiss after 5 seconds
        setTimeout(() => {
            dismissFlashMessage(flashMessage);
        }, 5000); // Changed to 5 seconds for better readability
    }

    function dismissFlashMessage(element) {
        element.style.transition = 'all 0.5s ease';
        element.style.opacity = '0';
        element.style.transform = 'translateY(-100%)';
        setTimeout(() => element.remove(), 500);
    }
});