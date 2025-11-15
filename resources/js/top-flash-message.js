setTimeout(() => {
    const flashMessage = document.getElementById('top-flash-message');
    console.log(flashMessage);
    if (flashMessage) {
        flashMessage.style.transition = 'all 0.5s ease';
        flashMessage.style.opacity = '0';
        flashMessage.style.transform = 'translateY(-100%)';
        setTimeout(() => flashMessage.remove(), 500);
    }
}, 3000);