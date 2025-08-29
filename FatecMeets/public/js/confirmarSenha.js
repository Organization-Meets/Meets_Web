document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById('cadastroForm');
    if (form) {
        form.addEventListener('submit', function(e) {
            const password = document.getElementById('password');
            const confirmar = document.getElementById('confirmar_password');
            if (password && confirmar && password.value !== confirmar.value) {
                alert('As senhas não coincidem!');
                e.preventDefault();
            }
        });
    }
});
