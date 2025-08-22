document.getElementById('cadastroForm').addEventListener('submit', function(e) {
    const password = document.getElementById('password').value;
    const confirmar = document.getElementById('confirmar_password').value;
    if (password !== confirmar) {
        alert('As senhas não coincidem!');
        e.preventDefault();
    }
});