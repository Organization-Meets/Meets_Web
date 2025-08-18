document.getElementById('cadastroForm').addEventListener('submit', function(e) {
    const senha = document.getElementById('senha').value;
    const confirmar = document.getElementById('confirmar_senha').value;
    if (senha !== confirmar) {
        alert('As senhas não coincidem!');
        e.preventDefault();
    }
});