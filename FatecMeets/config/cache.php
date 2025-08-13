<?php

use Illuminate\Support\Str;

return [

    /*
    |--------------------------------------------------------------------------
    | Armazenamento de Cache Padrão
    |--------------------------------------------------------------------------
    |
    | Esta opção controla a conexão de cache padrão que será utilizada ao usar
    | esta biblioteca de cache. Esta conexão é usada quando outra não é
    | explicitamente especificada ao executar uma determinada função de cache.
    |
    */

    'default' => env('CACHE_DRIVER', 'file'),

    /*
    |--------------------------------------------------------------------------
    | Armazenamentos de Cache
    |--------------------------------------------------------------------------
    |
    | Aqui você pode definir todos os "stores" (armazenamentos) de cache para sua
    | aplicação, bem como seus drivers. Você pode até definir múltiplos stores
    | para o mesmo driver de cache para agrupar tipos de itens armazenados.
    |
    | Drivers suportados: "apc", "array", "database", "file",
    |         "memcached", "redis", "dynamodb", "octane", "null"
    |
    */

    'stores' => [

        // Armazenamento usando o driver APC
        'apc' => [
            'driver' => 'apc',
        ],

        // Armazenamento em array, útil para testes e desenvolvimento
        'array' => [
            'driver' => 'array',
            'serialize' => false, // Define se os dados devem ser serializados
        ],

        // Armazenamento em banco de dados
        'database' => [
            'driver' => 'database',
            'table' => 'cache', // Nome da tabela de cache
            'connection' => null, // Conexão do banco de dados (null usa padrão)
            'lock_connection' => null, // Conexão para locks (null usa padrão)
        ],

        // Armazenamento em arquivos no sistema
        'file' => [
            'driver' => 'file',
            'path' => storage_path('framework/cache/data'), // Caminho dos arquivos de cache
        ],

        // Armazenamento usando Memcached
        'memcached' => [
            'driver' => 'memcached',
            'persistent_id' => env('MEMCACHED_PERSISTENT_ID'), // ID persistente para conexões
            'sasl' => [
                env('MEMCACHED_USERNAME'), // Usuário SASL
                env('MEMCACHED_PASSWORD'), // Senha SASL
            ],
            'options' => [
                // Opções do Memcached, exemplo: tempo de conexão
                // Memcached::OPT_CONNECT_TIMEOUT => 2000,
            ],
            'servers' => [
                [
                    'host' => env('MEMCACHED_HOST', '127.0.0.1'), // Host do servidor Memcached
                    'port' => env('MEMCACHED_PORT', 11211), // Porta do servidor
                    'weight' => 100, // Peso do servidor
                ],
            ],
        ],

        // Armazenamento usando Redis
        'redis' => [
            'driver' => 'redis',
            'connection' => 'cache', // Conexão Redis para cache
            'lock_connection' => 'default', // Conexão para locks
        ],

        // Armazenamento usando DynamoDB da AWS
        'dynamodb' => [
            'driver' => 'dynamodb',
            'key' => env('AWS_ACCESS_KEY_ID'), // Chave de acesso AWS
            'secret' => env('AWS_SECRET_ACCESS_KEY'), // Segredo de acesso AWS
            'region' => env('AWS_DEFAULT_REGION', 'us-east-1'), // Região AWS
            'table' => env('DYNAMODB_CACHE_TABLE', 'cache'), // Tabela DynamoDB
            'endpoint' => env('DYNAMODB_ENDPOINT'), // Endpoint personalizado
        ],

        // Armazenamento usando Octane
        'octane' => [
            'driver' => 'octane',
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Prefixo das Chaves de Cache
    |--------------------------------------------------------------------------
    |
    | Ao utilizar os armazenamentos APC, banco de dados, memcached, Redis ou
    | DynamoDB, pode haver outras aplicações usando o mesmo cache. Por isso,
    | você pode prefixar cada chave de cache para evitar colisões.
    |
    */

    'prefix' => env('CACHE_PREFIX', Str::slug(env('APP_NAME', 'laravel'), '_').'_cache_'),

];
