
</head>
<body>

<div class="conteudo">
    <button id="abrirLogin">Abrir Login</button>
</div>

<div class="login-overlay" id="loginOverlay">
    <div class="form-login">
        <h2>Login</h2>
        <form>
            <input type="text" placeholder="Usuário" required><br>
            <input type="password" placeholder="Senha" required><br>
            <button type="submit">Entrar</button>
        </form>
    </div>
</div>

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