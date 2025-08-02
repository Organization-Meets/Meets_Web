<?php
// view/cadastro.php
require __DIR__ . '/../config.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>view/css/estilo-cadastro.css">
</head>
<body>
    <div class="container">
        <h2>Cadastro</h2>

        <form action="<?= BASE_URL ?>../PHP/Processa_cadastro.php" method="POST">
            <input type="text" name="nome" placeholder="Nome Completo" required>
            <input type="text" name="usuario" placeholder="Apelido (Nickname)" required>
            <input type="email" name="email" placeholder="E-mail" required>
            <input type="tel" name="numero" placeholder="Número de Celular">
            <input type="password" name="senha" placeholder="Senha" required>
            <input type="password" name="repetir_senha" placeholder="Repetir Senha" required>
            <hr>
            <button type="submit">Cadastrar</button>
            <hr>
        </form>

        <a href="<?= BASE_URL ?>index.php"><button>Voltar</button></a>
    </div>
</body>
</html>
