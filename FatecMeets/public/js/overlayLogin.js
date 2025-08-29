
<script>
    const abrirLogin = document.getElementById('abrirLogin');
    const loginOverlay = document.getElementById('loginOverlay');
    const fecharLogin = document.getElementById('fecharLogin');

    abrirLogin.addEventListener('click', () => {
        loginOverlay.style.display = 'flex'; // Mostra o overlay
    });

    fecharLogin.addEventListener('click', () => {
        loginOverlay.style.display = 'none'; // Esconde o overlay
    });
</script>

</body>
</html>