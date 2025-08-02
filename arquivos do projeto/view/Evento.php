<?php
require __DIR__ . '/../config.php';

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario'])) {
    header('Location: ' . BASE_URL . 'view/Login.php');
    exit;
}

// Verifica se o ID foi passado
if (!isset($_GET['id'])) {
    die('Evento não especificado.');
}

$evento_id = $_GET['id'];

// Consulta do evento
$stmt = $pdo->prepare("SELECT e.*, u.nome, u.foto FROM eventos e
                       JOIN users u ON e.usuario_id = u.user_id
                       WHERE e.id = ?");
$stmt->execute([$evento_id]);
$evento = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$evento) {
    die('Evento não encontrado.');
}


?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($evento['titulo']) ?> - Evento</title>
    <link rel="stylesheet" href="css/estilo-evento.css">
    <link rel="stylesheet" href="css/dark-mode.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>components/navbar.css">
</head>
<body>

<?php include '../components/navbar.php'; ?>

<div class="meet-container post-content">
    <img src="../<?= htmlspecialchars($evento['imagem']) ?>" alt="Imagem do Evento" class="meet-image">

    <h1 class="meet-title"><?= htmlspecialchars($evento['titulo']) ?></h1>

    <p class="meet-description">
        <?= nl2br(htmlspecialchars($evento['descricao'])) ?>
    </p>

    <p><strong>Local:</strong> <?= htmlspecialchars($evento['local']) ?></p>
    <p><strong>Categoria:</strong> <?= htmlspecialchars($evento['categoria']) ?></p>
    <p><strong>Quando:</strong> <?= date('d/m/Y H:i', strtotime($evento['data_evento'])) ?></p>

    <div class="meet-buttons">
        <button onclick="confirmarPresenca()">Confirmar Presença</button>
        <button onclick="curtirPost()">Curtir ❤️</button>
    </div>
</div>

<script>
    function confirmarPresenca() {
        alert("Presença confirmada com sucesso!");
    }

    function curtirPost() {
        alert("Você curtiu este post!");
    }
</script>

</body>
</html>
