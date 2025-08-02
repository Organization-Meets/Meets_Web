<?php
// Ativa exibição de erros (desative em produção)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Inicia a sessão se ainda não foi iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Define a URL base apenas se ainda não estiver definida
if (!defined('BASE_URL')) {
    // ajuste se seu projeto estiver em subpasta
    
    // INFINITYFREE
    
    // define('BASE_URL', '/');

    define('BASE_URL', '/Fatec_Meets_Web/');
}

// Dados de conexão com banco de dados

// LOCALHOST

$host = 'localhost';
$db   = 'if0_38701439_fatecmeets';
$user = 'root';
$pass = '';

// PARA INFINITYFREE

// $host = 'sql312.infinityfree.com';
// $db   = 'if0_38701439_fatecmeets';
// $user = 'if0_38701439';
// $pass = 'Ye20N4PfvZ';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão com o banco de dados: " . $e->getMessage());
}
