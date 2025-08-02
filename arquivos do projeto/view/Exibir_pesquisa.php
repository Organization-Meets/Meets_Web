<?php
    require __DIR__ . '/../config.php';
    require __DIR__ . '/../components/navbar.php';

    // puxando a pesquisa de outra página
    require __DIR__ . '/../PHP/Realiza_pesquisa.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados - pesquisa</title>
    <link rel="stylesheet" href="css/estilo-feeds.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>

<!-- tela que exibe os resultados de pesquisa (igual ao index) -->

<div class="feed">

    <!-- exibição dos posts encontrados pela pesquisa -->
    <?php if (count($eventos) === 0): ?>
        <p style="text-align:center;">Nenhum evento ainda. Seja o primeiro a postar!</p>
    <?php else: ?>
        <?php foreach ($eventos as $evento): ?>
            <div class="post">
                <?php if ($evento['imagem']): ?>
                    <div class="post-image">
                        <img src="<?= htmlspecialchars('../'.$evento['imagem']) ?>" alt="Imagem do evento">
                    </div>
                <?php endif; ?>
                <div class="post-content">
                    <h3><?= htmlspecialchars($evento['titulo']) ?></h3>
                    <p><strong>Local:</strong> <?= htmlspecialchars($evento['local']) ?></p>
                    <p><strong>Categoria:</strong> <?= htmlspecialchars($evento['categoria']) ?></p>
                    <p><strong>Quando:</strong> <?= date('d/m/Y H:i', strtotime($evento['data_evento'])) ?></p>
                    <p><?= nl2br(htmlspecialchars($evento['descricao'])) ?></p>
                    <div class="post-footer">
                        Publicado em <?= date('d/m/Y H:i', strtotime($evento['data_criacao'])) ?> por:
                        <u><?= htmlspecialchars($evento['nome']) ?></u>
                        <img src="<?= htmlspecialchars('../'.$evento['foto']) ?>" class="profile-img-mini" alt="Foto perfil">
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>

</div>

</body>
</html>