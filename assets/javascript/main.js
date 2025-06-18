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
if (startButton) {
    startButton.addEventListener('click', function(e) {
        e.preventDefault();
        const modal = document.getElementById('loginModal');
        if (modal) {
            modal.classList.remove('hidden');
        
            const firstInput = modal.querySelector('input, button, select, textarea, a[href]');
            if (firstInput) firstInput.focus();
            
            modal.setAttribute('aria-hidden', 'false');
        }
    });
}


const modalClose = document.querySelector('.modal-close');
if (modalClose) {
    modalClose.addEventListener('click', function () {
        const modal = document.getElementById('loginModal');
        if (modal) {
            modal.classList.add('hidden');
            modal.setAttribute('aria-hidden', 'true');
        }
    });
}


const modal = document.getElementById('loginModal');
if (modal) { 
    modal.addEventListener('click', function (e) {
        if (e.target === this) {
            this.classList.add('hidden');
            this.setAttribute('aria-hidden', 'true');
        }
    });
}


document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape' || e.key === 'Esc') {
        const modal = document.getElementById('loginModal');
        if (modal && !modal.classList.contains('hidden')) {
            modal.classList.add('hidden');
            modal.setAttribute('aria-hidden', 'true');
        }
    }
});
