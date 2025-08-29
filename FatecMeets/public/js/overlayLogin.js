<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Overlay</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .conteudo {
            height: 100vh;
            background: url('sua-imagem.jpg') no-repeat center center/cover;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            display: none; /* Inicialmente escondido */
            justify-content: center;
            align-items: center;
            z-index: 999;
        }

        .form-login {
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
        }

        .fechar {
            cursor: pointer;
            color: red;
            margin-top: 10px;
        }
    </style>
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