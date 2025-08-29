const loginOverlay = document.getElementById('loginOverlay');
const fecharLogin = document.getElementById('fecharLogin');
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
if (loginOverlay) {
    loginOverlay.addEventListener('click', (e) => {
        if (e.target === loginOverlay) {
            loginOverlay.style.display = 'none';
        }
    });
}

// === TOKEN ===
const tokenOverlay = document.getElementById('tokenOverlay');
const fecharToken = document.getElementById('fecharToken');
document.querySelectorAll('.abrirToken').forEach((btn) => {
    btn.addEventListener('click', (e) => {
        e.preventDefault();
        tokenOverlay.style.display = 'flex';
    });
});
if (fecharToken) {
    fecharToken.addEventListener('click', () => {
        tokenOverlay.style.display = 'none';
    });
}
if (tokenOverlay) {
    tokenOverlay.addEventListener('click', (e) => {
        if (e.target === tokenOverlay) {
            tokenOverlay.style.display = 'none';
        }
    });
}