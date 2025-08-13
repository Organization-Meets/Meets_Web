<?php

use Monolog\Handler\NullHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\SyslogUdpHandler;

// Este arquivo retorna um array de configuração para o sistema de logs do Laravel.
// Ele define os canais de log, níveis, formatos e handlers utilizados pela aplicação.

return [

    /*
    |--------------------------------------------------------------------------
    | Canal de Log Padrão
    |--------------------------------------------------------------------------
    |
    | Esta opção define o canal de log padrão que será utilizado ao escrever
    | mensagens nos logs. O nome especificado nesta opção deve corresponder
    | a um dos canais definidos no array de configuração "channels".
    |
    */
    'default' => env('LOG_CHANNEL', 'stack'),

    /*
    |--------------------------------------------------------------------------
    | Canal de Log para Deprecações
    |--------------------------------------------------------------------------
    |
    | Esta opção controla o canal de log que deve ser usado para registrar avisos
    | sobre recursos PHP e de bibliotecas que estão obsoletos. Isso permite que
    | você prepare sua aplicação para futuras versões principais das dependências.
    |
    */
    'deprecations' => [
        // Canal utilizado para registrar deprecações
        'channel' => env('LOG_DEPRECATIONS_CHANNEL', 'null'),
        // Define se o rastreamento (trace) será incluído nos logs de deprecação
        'trace' => false,
    ],

    /*
    |--------------------------------------------------------------------------
    | Canais de Log
    |--------------------------------------------------------------------------
    |
    | Aqui você pode configurar os canais de log para sua aplicação. Por padrão,
    | o Laravel utiliza a biblioteca de logs Monolog em PHP. Isso oferece uma
    | variedade de handlers e formatadores de log poderosos para utilizar.
    |
    | Drivers disponíveis: "single", "daily", "slack", "syslog",
    |                     "errorlog", "monolog",
    |                     "custom", "stack"
    |
    */
    'channels' => [
        // Canal que empilha outros canais de log
        'stack' => [
            'driver' => 'stack', // Tipo do driver
            'channels' => ['single'], // Canais empilhados
            'ignore_exceptions' => false, // Ignora exceções dos canais
        ],

        // Canal que registra todos os logs em um único arquivo
        'single' => [
            'driver' => 'single', // Tipo do driver
            'path' => storage_path('logs/laravel.log'), // Caminho do arquivo de log
            'level' => env('LOG_LEVEL', 'debug'), // Nível mínimo do log
        ],

        // Canal que registra logs diariamente, criando um arquivo por dia
        'daily' => [
            'driver' => 'daily', // Tipo do driver
            'path' => storage_path('logs/laravel.log'), // Caminho do arquivo de log
            'level' => env('LOG_LEVEL', 'debug'), // Nível mínimo do log
            'days' => 14, // Quantidade de dias para manter os arquivos de log
        ],

        // Canal que envia logs para o Slack
        'slack' => [
            'driver' => 'slack', // Tipo do driver
            'url' => env('LOG_SLACK_WEBHOOK_URL'), // URL do webhook do Slack
            'username' => 'Laravel Log', // Nome de usuário exibido no Slack
            'emoji' => ':boom:', // Emoji exibido na mensagem
            'level' => env('LOG_LEVEL', 'critical'), // Nível mínimo do log
        ],

        // Canal que envia logs para o Papertrail usando UDP
        'papertrail' => [
            'driver' => 'monolog', // Tipo do driver
            'level' => env('LOG_LEVEL', 'debug'), // Nível mínimo do log
            'handler' => env('LOG_PAPERTRAIL_HANDLER', SyslogUdpHandler::class), // Handler utilizado
            'handler_with' => [
                'host' => env('PAPERTRAIL_URL'), // Host do Papertrail
                'port' => env('PAPERTRAIL_PORT'), // Porta do Papertrail
                'connectionString' => 'tls://'.env('PAPERTRAIL_URL').':'.env('PAPERTRAIL_PORT'), // String de conexão TLS
            ],
        ],

        // Canal que envia logs para a saída padrão de erro (stderr)
        'stderr' => [
            'driver' => 'monolog', // Tipo do driver
            'level' => env('LOG_LEVEL', 'debug'), // Nível mínimo do log
            'handler' => StreamHandler::class, // Handler utilizado
            'formatter' => env('LOG_STDERR_FORMATTER'), // Formatador do log
            'with' => [
                'stream' => 'php://stderr', // Stream de saída
            ],
        ],

        // Canal que envia logs para o syslog do sistema
        'syslog' => [
            'driver' => 'syslog', // Tipo do driver
            'level' => env('LOG_LEVEL', 'debug'), // Nível mínimo do log
        ],

        // Canal que envia logs para o errorlog do PHP
        'errorlog' => [
            'driver' => 'errorlog', // Tipo do driver
            'level' => env('LOG_LEVEL', 'debug'), // Nível mínimo do log
        ],

        // Canal que descarta todos os logs (não registra nada)
        'null' => [
            'driver' => 'monolog', // Tipo do driver
            'handler' => NullHandler::class, // Handler que descarta os logs
        ],

        // Canal de emergência, utilizado quando não é possível registrar em outros canais
        'emergency' => [
            'path' => storage_path('logs/laravel.log'), // Caminho do arquivo de log de emergência
        ],
    ],

];
