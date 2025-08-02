<?php
require __DIR__ . '/../config.php';

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario'])) {
    header('Location: ' . BASE_URL . 'view/Login.php');
    exit;
}

// Dados do usuário logado
$usuario = $_SESSION['usuario'];
$foto = !empty($usuario['foto']) ? BASE_URL . $usuario['foto'] : 'https://i.pravatar.cc/150?img=32';


?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Perfil - Meets</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>view/css/estilo-editar-perfil.css">
</head>
<body>

<section class="edit-profile-container">
    <h1>Editar Perfil</h1>

    <?php if ($mensagem): ?>
        <p class="mensagem-sucesso"><?= htmlspecialchars($mensagem) ?></p>
    <?php endif; ?>

    <form action="<?= BASE_URL ?>PHP/PerfilEdit.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="nome">Nome completo:</label>
            <input type="text" name="nome" id="nome" value="<?= htmlspecialchars($_SESSION['usuario']['nome'] ?? '') ?>" required>
        </div>

        <div class="form-group">
            <label for="foto">Foto de perfil:</label><br>
            <input type="file" name="foto" id="foto" accept="image/*">
            <div class="foto-atual">
                <p>Foto atual:</p>
                <img src="<?= BASE_URL . htmlspecialchars($_SESSION['usuario']['foto'] ?? 'https://i.pravatar.cc/150?img=32') ?>" alt="Foto atual" width="100">
            </div>
        </div>

        <button type="submit" class="btn-salvar">Salvar Alterações</button>
    </form>
</section>

</body>
</html>
