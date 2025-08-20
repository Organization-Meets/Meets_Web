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
        <input type="password" name="senha" placeholder="Senha" required>
        <button type="submit">Entrar</button>

        <hr>
        <p style="text-align:center; margin:15px 0; font-size:14px;">
            Não tem uma conta? 
            <a href="/usuarios/create/" style="color:#28a745;">Cadastre-se aqui</a>
        </p>
    </form>

    <a href="/home/"><button type="button">Voltar</button></a>
</div>

<script>
document.getElementById("loginForm").addEventListener("submit", async function(e){
    e.preventDefault();
    const form = e.target;
    const formData = new FormData(form);

    try {
        const response = await fetch("/usuarios/login", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
            },
            body: formData
        });

        const result = await response.json();
        console.log("Retorno backend:", result);

        if(response.ok && result.success){
            alert("Login realizado com sucesso!");
            window.location.href = "/usuarios/perfil";
        } else {
            alert("❌ E-mail ou senha incorretos.");
        }

    } catch(err) {
        console.error(err);
        alert("Erro ao tentar logar!");
    }
});
</script>

</body>
</html>
