<?php

use Illuminate\Support\Str;

return [

    /*
    |--------------------------------------------------------------------------
    | Nome da Conexão de Banco de Dados Padrão
    |--------------------------------------------------------------------------
    |
    | Aqui você pode especificar qual das conexões de banco de dados abaixo
    | deseja usar como sua conexão padrão para todo o trabalho com banco de dados.
    | Claro, você pode usar várias conexões ao mesmo tempo usando a biblioteca Database.
    |
    */

    'default' => env('DB_CONNECTION', 'mysql'),

    /*
    |--------------------------------------------------------------------------
    | Conexões de Banco de Dados
    |--------------------------------------------------------------------------
    |
    | Aqui estão todas as conexões de banco de dados configuradas para sua aplicação.
    | Exemplos de configuração para cada plataforma de banco de dados suportada pelo
    | Laravel são mostrados abaixo para facilitar o desenvolvimento.
    |
    | Todo o trabalho com banco de dados no Laravel é feito através das facilidades
    | do PHP PDO, então certifique-se de ter o driver para o banco de dados escolhido
    | instalado em sua máquina antes de começar o desenvolvimento.
    |
    */

    'connections' => [

        // Configuração para banco de dados SQLite
        'sqlite' => [
            'driver' => 'sqlite', // Driver utilizado
            'url' => env('DATABASE_URL'), // URL de conexão
            'database' => env('DB_DATABASE', database_path('database.sqlite')), // Caminho do arquivo do banco
            'prefix' => '', // Prefixo das tabelas
            'foreign_key_constraints' => env('DB_FOREIGN_KEYS', true), // Respeitar restrições de chave estrangeira
        ],

        // Configuração para banco de dados MySQL
        'mysql' => [
            'driver' => 'mysql', // Driver utilizado
            'url' => env('DATABASE_URL'), // URL de conexão
            'host' => env('DB_HOST', '127.0.0.1'), // Host do banco
            'port' => env('DB_PORT', '3306'), // Porta do banco
            'database' => env('DB_DATABASE', 'forge'), // Nome do banco
            'username' => env('DB_USERNAME', 'forge'), // Usuário do banco
            'password' => env('DB_PASSWORD', ''), // Senha do banco
            'unix_socket' => env('DB_SOCKET', ''), // Socket Unix (opcional)
            'charset' => 'utf8mb4', // Charset utilizado
            'collation' => 'utf8mb4_unicode_ci', // Collation utilizado
            'prefix' => '', // Prefixo das tabelas
            'prefix_indexes' => true, // Prefixar índices
            'strict' => true, // Modo estrito
            'engine' => null, // Engine do banco (opcional)
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'), // Caminho do certificado SSL (opcional)
            ]) : [],
        ],

        // Configuração para banco de dados PostgreSQL
        'pgsql' => [
            'driver' => 'pgsql', // Driver utilizado
            'url' => env('DATABASE_URL'), // URL de conexão
            'host' => env('DB_HOST', '127.0.0.1'), // Host do banco
            'port' => env('DB_PORT', '5432'), // Porta do banco
            'database' => env('DB_DATABASE', 'forge'), // Nome do banco
            'username' => env('DB_USERNAME', 'forge'), // Usuário do banco
            'password' => env('DB_PASSWORD', ''), // Senha do banco
            'charset' => 'utf8', // Charset utilizado
            'prefix' => '', // Prefixo das tabelas
            'prefix_indexes' => true, // Prefixar índices
            'search_path' => 'public', // Schema padrão
            'sslmode' => 'prefer', // Modo SSL
        ],

        // Configuração para banco de dados SQL Server
        'sqlsrv' => [
            'driver' => 'sqlsrv', // Driver utilizado
            'url' => env('DATABASE_URL'), // URL de conexão
            'host' => env('DB_HOST', 'localhost'), // Host do banco
            'port' => env('DB_PORT', '1433'), // Porta do banco
            'database' => env('DB_DATABASE', 'forge'), // Nome do banco
            'username' => env('DB_USERNAME', 'forge'), // Usuário do banco
            'password' => env('DB_PASSWORD', ''), // Senha do banco
            'charset' => 'utf8', // Charset utilizado
            'prefix' => '', // Prefixo das tabelas
            'prefix_indexes' => true, // Prefixar índices
            // 'encrypt' => env('DB_ENCRYPT', 'yes'), // Criptografia (opcional)
            // 'trust_server_certificate' => env('DB_TRUST_SERVER_CERTIFICATE', 'false'), // Confiar no certificado do servidor (opcional)
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Tabela do Repositório de Migrações
    |--------------------------------------------------------------------------
    |
    | Esta tabela mantém o controle de todas as migrações que já foram executadas
    | para sua aplicação. Usando esta informação, podemos determinar quais das
    | migrações no disco ainda não foram executadas no banco de dados.
    |
    */

    'migrations' => 'migrations',

    /*
    |--------------------------------------------------------------------------
    | Bancos de Dados Redis
    |--------------------------------------------------------------------------
    |
    | Redis é um sistema de armazenamento de chave-valor rápido e avançado que
    | também fornece um conjunto de comandos mais rico do que sistemas típicos
    | de chave-valor como APC ou Memcached. O Laravel facilita o uso do Redis.
    |
    */

    'redis' => [

        'client' => env('REDIS_CLIENT', 'phpredis'), // Cliente Redis utilizado

        'options' => [
            'cluster' => env('REDIS_CLUSTER', 'redis'), // Tipo de cluster
            'prefix' => env('REDIS_PREFIX', Str::slug(env('APP_NAME', 'laravel'), '_').'_database_'), // Prefixo das chaves
        ],

        // Configuração padrão do Redis
        'default' => [
            'url' => env('REDIS_URL'), // URL de conexão
            'host' => env('REDIS_HOST', '127.0.0.1'), // Host do Redis
            'username' => env('REDIS_USERNAME'), // Usuário do Redis (opcional)
            'password' => env('REDIS_PASSWORD'), // Senha do Redis (opcional)
            'port' => env('REDIS_PORT', '6379'), // Porta do Redis
            'database' => env('REDIS_DB', '0'), // Banco de dados Redis
        ],

        // Configuração de cache do Redis
        'cache' => [
            'url' => env('REDIS_URL'), // URL de conexão
            'host' => env('REDIS_HOST', '127.0.0.1'), // Host do Redis
            'username' => env('REDIS_USERNAME'), // Usuário do Redis (opcional)
            'password' => env('REDIS_PASSWORD'), // Senha do Redis (opcional)
            'port' => env('REDIS_PORT', '6379'), // Porta do Redis
            'database' => env('REDIS_CACHE_DB', '1'), // Banco de dados Redis para cache
        ],

    ],

];
