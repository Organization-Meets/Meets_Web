<?php
require_once '../config.php';

if (!isset($_SESSION['usuario'])) {
    header("Location: ../view/Login.php");
    exit;
}

$usuario_id = $_SESSION['usuario']['id'];
$titulo = $_POST['titulo'];
$local = $_POST['local'];
$categoria = $_POST['categoria'];
$data_evento = $_POST['data_evento'];
$descricao = $_POST['descricao'];
$imagem = null;

// Upload da imagem
if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
    $nomeImagem = uniqid() . '-' . basename($_FILES['imagem']['name']);
    $caminhoImagem = '../uploads/' . $nomeImagem;
    if (!is_dir('../uploads')) {
        mkdir('../uploads', 0777, true);
    }
    move_uploaded_file($_FILES['imagem']['tmp_name'], $caminhoImagem);
    $imagem = 'uploads/' . $nomeImagem;
}

// Salvar no banco
$stmt = $pdo->prepare("INSERT INTO eventos (usuario_id, titulo, local, categoria, data_evento, descricao, imagem) 
                       VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->execute([$usuario_id, $titulo, $local, $categoria, $data_evento, $descricao, $imagem]);

header("Location: ../index.php");
exit;
?>