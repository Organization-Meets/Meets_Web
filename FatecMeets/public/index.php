<?php

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;

// Define o início da execução do Laravel, usado para medir o tempo de carregamento
define('LARAVEL_START', microtime(true));

/*
|--------------------------------------------------------------------------
| Verifica Se a Aplicação Está em Manutenção
|--------------------------------------------------------------------------
|
| Se a aplicação estiver em modo de manutenção / demonstração via o comando "down",
| este arquivo será carregado para que qualquer conteúdo pré-renderizado possa ser exibido
| ao invés de iniciar o framework, o que poderia causar uma exceção.
|
*/
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance; // Carrega o arquivo de manutenção, se existir
}

/*
|--------------------------------------------------------------------------
| Registra o Auto Loader
|--------------------------------------------------------------------------
|
| O Composer fornece um carregador de classes conveniente e gerado automaticamente para
| esta aplicação. Só precisamos utilizá-lo! Basta requerer o arquivo aqui para não
| precisarmos carregar as classes manualmente.
|
*/
require __DIR__.'/../vendor/autoload.php'; // Carrega o autoloader do Composer

/*
|--------------------------------------------------------------------------
| Executa a Aplicação
|--------------------------------------------------------------------------
|
| Após obter a aplicação, podemos tratar a requisição recebida usando
| o kernel HTTP da aplicação. Em seguida, enviamos a resposta de volta
| ao navegador do cliente, permitindo que ele utilize nossa aplicação.
|
*/
$app = require_once __DIR__.'/../bootstrap/app.php'; // Inicializa a aplicação Laravel

$kernel = $app->make(Kernel::class); // Cria uma instância do Kernel HTTP

$response = $kernel->handle(
    $request = Request::capture() // Captura a requisição HTTP
)->send(); // Envia a resposta ao cliente

$kernel->terminate($request, $response); // Finaliza a requisição e executa tarefas pós-resposta

