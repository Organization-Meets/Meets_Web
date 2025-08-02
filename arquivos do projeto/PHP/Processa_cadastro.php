<?php
require __DIR__ . '/../config.php';

function redirecionaComMensagem($mensagem)
{
    echo "<!DOCTYPE html>
    <html lang='pt-BR'>
    <head>
        <meta charset='UTF-8'>
        <title>Cadastro</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f9f9f9;
                text-align: center;
                padding: 50px;
            }
            .mensagem {
                background-color: #fff3cd;
                color: #856404;
                padding: 20px;
                border-radius: 10px;
                border: 1px solid #ffeeba;
                display: inline-block;
                margin-bottom: 20px;
            }
            a {
                display: inline-block;
                margin-top: 15px;
                text-decoration: none;
                color: #007bff;
            }
        </style>
    </head>
    <body>
        <div class='mensagem'>
            <strong>$mensagem</strong><br>
            <a href='../view/cadastro.php'>Voltar para o cadastro</a>
        </div>
    </body>
    </html>";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = $_POST['nome'] ?? '';
    $email = $_POST['email'] ?? '';
    $usuario = $_POST['usuario'] ?? '';
    $numero = $_POST['numero'] ?? '';
    $senha = $_POST['senha'] ?? '';
    $repetir_senha = $_POST['repetir_senha'] ?? '';

    if ($senha !== $repetir_senha) {
        redirecionaComMensagem("❌ As senhas não coincidem!");
    }

    $stmt_verifica = $pdo->prepare("SELECT email FROM users WHERE email = :email");
    $stmt_verifica->execute([':email' => $email]);

    if ($stmt_verifica->fetch()) {
        redirecionaComMensagem("⚠️ Este e-mail já está cadastrado!");
    }

    $senha_cripto = password_hash($senha, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (nome, email, nickname, numero, senha) 
        VALUES (:nome, :email, :nickmaname, :numero, :senha)";
    $stmt = $pdo->prepare($sql);
    $sucesso = $stmt->execute([
        ':nome' => $nome,
        ':email' => $email,
        ':nickmaname' => $usuario,
        ':numero' => $numero,
        ':senha' => $senha_cripto,
    ]);


    if ($sucesso) {
        header("Location: " . BASE_URL . "index.php");
        exit();
    } else {
        redirecionaComMensagem("Erro ao cadastrar. Tente novamente.");
    }
} else {
    redirecionaComMensagem("Acesso inválido ao formulário.");
}
