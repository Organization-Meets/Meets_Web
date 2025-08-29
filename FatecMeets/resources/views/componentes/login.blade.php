<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="/css/estilo-cadastro.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>

<div class="container">
    <h2>Login</h2>

    <form id="loginForm">
        @csrf
        <img src="/imagens/logo.png" alt="Logo" style="width:100px; margin:0 auto 15px; display:block;">

        <input type="email" name="email" placeholder="E-mail" required>
        <input type="password" name="password" placeholder="Senha" required>
        <button type="submit">Entrar</button>

        <hr>
        <p style="text-align:center; margin:15px 0; font-size:14px;">
            Não tem uma conta? 
            <a href="/usuarios/create/" style="color:#28a745;">Cadastre-se aqui</a>
        </p>
    </form>

    <a href="../../"><button type="button">Voltar</button></a>
</div>

<script src="js/controllers/componentes/loginController.js"></script>
</body>
</html>
