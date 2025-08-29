const loginOverlay = document.getElementById('loginOverlay');
const fecharLogin = document.getElementById('fecharLogin');

if (loginOverlay) {
    document.querySelectorAll('.abrirLogin').forEach((btn) => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            loginOverlay.style.display = 'flex';
        });
    });

    if (fecharLogin) {
        fecharLogin.addEventListener('click', () => {
            loginOverlay.style.display = 'none';
        });
    }

    loginOverlay.addEventListener('click', (e) => {
        if (e.target === loginOverlay) {
            loginOverlay.style.display = 'none';
        }
    });
}
