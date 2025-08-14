<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="/css/estilo-cadastro.css">
</head>
<body>
    <div class="container">
        <h2>Cadastro</h2>

        <form action="/usuarios" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="email" name="email" placeholder="E-mail" required>
            <input type="password" name="senha" placeholder="Senha" required>
            <input type="file" name="imagem_usuario" accept="image/*">
            <input type="hidden" name="id_endereco" value="">
            <hr>
            <button type="submit">Cadastrar</button>
            <hr>
        </form>

        <a href="/home/"><button type="button">Voltar</button></a>
    </div>
</body>
</html>