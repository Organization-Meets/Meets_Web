<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Broadcaster Padrão
    |--------------------------------------------------------------------------
    |
    | Esta opção controla o broadcaster padrão que será utilizado pelo framework
    | quando um evento precisar ser transmitido. Você pode definir para qualquer
    | uma das conexões especificadas no array "connections" abaixo.
    |
    | Suportado: "pusher", "ably", "redis", "log", "null"
    |
    */

    'default' => env('BROADCAST_DRIVER', 'null'), // Define o driver padrão de broadcast, usando variável de ambiente ou 'null'

    /*
    |--------------------------------------------------------------------------
    | Conexões de Broadcast
    |--------------------------------------------------------------------------
    |
    | Aqui você pode definir todas as conexões de broadcast que serão usadas
    | para transmitir eventos para outros sistemas ou via websockets. Exemplos
    | de cada tipo de conexão disponível estão fornecidos neste array.
    |
    */

    'connections' => [

        // Configuração para o serviço Pusher
        'pusher' => [
            'driver' => 'pusher', // Define o driver como 'pusher'
            'key' => env('PUSHER_APP_KEY'), // Chave do aplicativo Pusher (variável de ambiente)
            'secret' => env('PUSHER_APP_SECRET'), // Segredo do aplicativo Pusher (variável de ambiente)
            'app_id' => env('PUSHER_APP_ID'), // ID do aplicativo Pusher (variável de ambiente)
            'options' => [
                // Configurações adicionais do Pusher
                'host' => env('PUSHER_HOST') ?: 'api-'.env('PUSHER_APP_CLUSTER', 'mt1').'.pusher.com', // Host do Pusher
                'port' => env('PUSHER_PORT', 443), // Porta do Pusher (padrão 443)
                'scheme' => env('PUSHER_SCHEME', 'https'), // Esquema de conexão (http ou https)
                'encrypted' => true, // Define se a conexão será criptografada
                'useTLS' => env('PUSHER_SCHEME', 'https') === 'https', // Usa TLS se o esquema for https
            ],
            'client_options' => [
                // Opções do cliente Guzzle: https://docs.guzzlephp.org/en/stable/request-options.html
            ],
        ],

        // Configuração para o serviço Ably
        'ably' => [
            'driver' => 'ably', // Define o driver como 'ably'
            'key' => env('ABLY_KEY'), // Chave do Ably (variável de ambiente)
        ],

        // Configuração para o serviço Redis
        'redis' => [
            'driver' => 'redis', // Define o driver como 'redis'
            'connection' => 'default', // Nome da conexão Redis a ser usada
        ],

        // Configuração para log (apenas registra os eventos)
        'log' => [
            'driver' => 'log', // Define o driver como 'log'
        ],

        // Configuração nula (não transmite eventos)
        'null' => [
            'driver' => 'null', // Define o driver como 'null'
        ],

    ],

];
