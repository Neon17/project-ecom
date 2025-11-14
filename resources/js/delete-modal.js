var delete_modal = document.getElementsByClassName('delete-modal');
var close_delete_modal = document.getElementsByClassName('close-delete-modal');
var open_delete_model = document.getElementsByClassName('open-delete-model');

console.log(delete_modal);

for (let i = 0; i < open_delete_model.length; i++) {
    open_delete_model[i].addEventListener('click', function () {
        delete_modal[i].classList.remove('hidden');
    });
}

for (let i = 0; i < close_delete_modal.length; i++) {
    close_delete_modal[i].addEventListener('click', function () {
        delete_modal[i].classList.add('hidden');
    });
}

for (let i = 0; i < delete_modal.length; i++) {
    window.addEventListener('click', function (e) {
        if (e.target == delete_modal[i]) {
            delete_modal[i].classList.add('hidden');
        }
    });
}

window.addEventListener('keydown', function (e) {
    if (e.key == 'Escape') {
        for (let i = 0; i < delete_modal.length; i++) {
            delete_modal[i].classList.add('hidden');
        }
    }
});
