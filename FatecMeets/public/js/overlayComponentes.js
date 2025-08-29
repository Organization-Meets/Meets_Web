const loginOverlay = document.getElementById('loginOverlay');
const fecharLogin = document.getElementById('fecharLogin');

// Todos os elementos que abrem login
document.querySelectorAll('.abrirLogin').forEach((btn) => {
    btn.addEventListener('click', (e) => {
        e.preventDefault();
        loginOverlay.style.display = 'flex';
    });
});

// Fechar overlay
if (fecharLogin) {
    fecharLogin.addEventListener('click', () => {
        loginOverlay.style.display = 'none';
    });
}

// Fechar clicando fora do form
if (loginOverlay) {
    loginOverlay.addEventListener('click', (e) => {
        if (e.target === loginOverlay) {
            loginOverlay.style.display = 'none';
        }
    });
}
