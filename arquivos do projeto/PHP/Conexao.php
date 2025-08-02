<?php

// components/navbar.php
// Incluir o arquivo de configuração
require __DIR__ . '/config.php';

// Configurações do banco de dados
$servidor = "localhost"; // onde o MySQL está instalado
$usuario = "root"; // usuário do banco (padrão XAMPP/WAMP é 'root')
$senha = ""; // senha do banco (vazia por padrão no XAMPP/WAMP)
$banco = "cadastro_usuario"; // nome do banco que vamos usar



// Criar conexão
$conexao = new mysqli($servidor, $usuario, $senha, $banco);

// Verificar se houve erro
if ($conexao->connect_error) {
    die("Erro na conexão: " . $conexao->connect_error);
}

// Definir o charset para utf8 (para aceitar caracteres especiais)
$conexao->set_charset("utf8");


?>