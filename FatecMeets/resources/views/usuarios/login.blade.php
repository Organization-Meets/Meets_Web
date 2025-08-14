<?php
require __DIR__ . '/../config.php'; // caminho corrigido
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>view/css/estilo-cadastro.css"> <!-- CSS compartilhado -->
</head>
<body>

    <?php if (isset($_GET['erro'])): ?>
        <div style="color: red; text-align: center; margin-bottom: 10px;">
            ❌ E-mail ou senha incorretos. Tente novamente.
        </div>
    <?php endif; ?>

    <div class="container">
        <h2>Login</h2>

        <form action="<?= BASE_URL ?>PHP/Valida.php" method="POST">
            <img src="<?= BASE_URL ?>view/imagens/logo.png" alt="Logo" style="width: 100px; margin-bottom: 15px; display: block; margin-left: auto; margin-right: auto;">

            <input type="email" name="email" placeholder="E-mail" required>
            <input type="password" name="senha" placeholder="Senha" required>
            <button type="submit">Entrar</button>
            <hr>
            <p style="text-align: center; margin: 15px 0; font-size: 14px;">
                Não tem uma conta? 
                <a href="<?= BASE_URL ?>view/Cadastro.php" style="color: #28a745;">Cadastre-se aqui</a>
            </p>
        </form>

        <a href="<?= BASE_URL ?>index.php"><button>Voltar</button></a>

        <!-- teste do Vlibras -->
        <div vw class="enabled">
        <div vw-access-button class="active"></div>
        <div vw-plugin-wrapper>
        <div class="vw-plugin-top-wrapper"></div>
        </div>
        </div>
        <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
        <script>
        new window.VLibras.Widget('https://vlibras.gov.br/app');
        </script>
        
    </div>
</body>
</html>
