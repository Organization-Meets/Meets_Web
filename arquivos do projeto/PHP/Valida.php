<?php
// PHP/Valida.php

require __DIR__ . '/../config.php'; // Já inicia sessão e define BASE_URL

function redirecionaComErro() {
    header('Location: ' . BASE_URL . 'view/Login.php');
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';

    // Validação básica
    if (empty($email) || empty($senha)) {
        redirecionaComErro();
    }

    // Consulta com PDO
    $stmt = $pdo->prepare("SELECT user_id, nome, email, profile_image, senha FROM users WHERE email = :email");
    $stmt->execute([':email' => $email]);
    $usuario = $stmt->fetch();

    if ($usuario && password_verify($senha, $usuario['senha'])) {
        $_SESSION['usuario'] = [
            'id'    => $usuario['user_id'],
            'nome'  => $usuario['nome'],
            'email' => $usuario['email'],
            'foto'  => $usuario['profile_image'] ?? 'https://i.pravatar.cc/150?img=32'
        ];

        header("Location: " . BASE_URL . "index.php");
        exit;
    }

    // Falha no login
    redirecionaComErro();
} else {
    redirecionaComErro(); // Evita acesso direto via GET
}
