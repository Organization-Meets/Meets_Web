<?php

// Defina o caminho para o diretório 'public' do Laravel
$publicDir = __DIR__ . '/public';

// Verifique se o diretório 'public' existe
if (is_dir($publicDir)) {
    // Inclua o arquivo 'index.php' do diretório 'public'
    require_once $publicDir . '/index.php';
} else {
    // Caso o diretório 'public' não exista, exiba uma mensagem de erro
    echo "Erro: O diretório 'public' não foi encontrado.";
}
?>