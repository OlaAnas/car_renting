const accountImage = document.querySelector('.account img');
if (accountImage) {
    accountImage.addEventListener('click', function (e) {
        e.stopPropagation();
        const account = this.closest('.account');
        account.classList.toggle('active');
    });

    document.addEventListener('click', function (e) {
        const account = document.querySelector('.account');
        if (account && !account.contains(e.target)) {
            account.classList.remove('active');
        }
    });
}

const startButton = document.querySelector('.button-primary');
const modal = document.getElementById('loginModal');
const closeBtn = modal?.querySelector('.modal-close');

function openModal() {
    modal.classList.remove('hidden');
    modal.setAttribute('aria-hidden', 'false');

    const firstInput = modal.querySelector('input, button, select, textarea, a[href]');
    if (firstInput) firstInput.focus();
}

function closeModal() {
    modal.classList.add('hidden');
    modal.setAttribute('aria-hidden', 'true');
}


if (startButton && modal) {
    startButton.addEventListener('click', function(e) {
        e.preventDefault();
        openModal();
    });
}


if (closeBtn) {
    closeBtn.addEventListener('click', function() {
        closeModal();
    });
}

document.addEventListener('click', function(e) {
    if (!modal.classList.contains('hidden') && !modal.contains(e.target) && !e.target.closest('.button-primary')) {
        closeModal();
    }
});

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
        closeModal();
    }
});


const openLoginBtn = document.getElementById('openLogin');
if (openLoginBtn && modal) {
    openLoginBtn.addEventListener('click', function(e) {
        e.preventDefault();
        openModal();
    });
}
