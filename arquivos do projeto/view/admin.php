<?php
require_once __DIR__ . '/../config.php';
// Inicia sessão apenas se ainda não houver uma
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

// Página de administração acessível apenas via URL direta
// Futuramente: validar permissão de administrador

// Simulação de perfil de usuário com privilégios
$adminUser = [
    'nome' => 'Felipe Catarino',
    
    'avatar' => BASE_URL . 'view/imagens/icons/imgPadrao.png',
    'funcao' => 'Administrador'
];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin - Publicações Reportadas</title>
    <!-- CSS principal do projeto -->
    <link rel="stylesheet" href="<?= BASE_URL ?>view/css/estilo-admin.css">

</head>
<body>

    <?php include '../components/navbar.php'; ?>


    <div class="admin-wrapper">
        <div class="admin-header">
            <div class="admin-profile">
                <img src="imagens/icons/imgPadrao.png" alt="Avatar do administrador">
                <div class="info">
                    <span class="name"><?= $adminUser['nome'] ?></span>
                    <span class="role"><?= $adminUser['funcao'] ?></span>
                </div>
            </div>
            <div class="admin-title">🔒 Painel Admin - Publicações Reportadas</div>
        </div>

        <div class="reported-list">
            <!-- Post reportado #1 -->
            <div class="reported-item">
                <img class="post-image" src="<?= BASE_URL ?>view/imagens/offensive1.jpg" alt="Imagem do post ofensivo">
                <h2>Motivo: Conteúdo Ofensivo</h2>
                <div class="meta">Usuário: João da Silva | Publicado em: 15/06/2025 às 14:32</div>
                <p>“Esse evento é um lixo, só idiotas participam.”</p>
                <div class="actions">
                    <button class="btn-approve">Marcar como OK</button>
                    <button class="btn-delete">Excluir Post</button>
                    <button class="btn-block">Bloquear Usuário</button>
                </div>
            </div>

            <!-- Post reportado #2 -->
            <div class="reported-item">
                <img class="post-image" src="<?= BASE_URL ?>view/imagens/spam1.jpg" alt="Imagem do post de spam">
                <h2>Motivo: Spam / Propaganda Indevida</h2>
                <div class="meta">Usuário: Carla Souza | Publicado em: 14/06/2025 às 09:15</div>
                <p>“Participe do meu canal de vendas de suplementos! Link na bio!”</p>
                <div class="actions">
                    <button class="btn-approve">Marcar como OK</button>
                    <button class="btn-delete">Excluir Post</button>
                    <button class="btn-block">Bloquear Usuário</button>
                </div>
            </div>

            <!-- Post reportado #3 -->
            <div class="reported-item">
                <img class="post-image" src="<?= BASE_URL ?>view/imagens/hate1.jpg" alt="Imagem do post de discurso de ódio">
                <h2>Motivo: Discurso de Ódio</h2>
                <div class="meta">Usuário: Marcos Lima | Publicado em: 13/06/2025 às 18:50</div>
                <p>“As pessoas daquele bairro são preguiçosas e malandras.”</p>
                <div class="actions">
                    <button class="btn-approve">Marcar como OK</button>
                    <button class="btn-delete">Excluir Post</button>
                    <button class="btn-block">Bloquear Usuário</button>
                </div>
            </div>
        </div>
    </div>

</body>
</html>