<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Nome da Conexão de Fila Padrão
    |--------------------------------------------------------------------------
    |
    | A API de filas do Laravel suporta diversos back-ends através de uma única
    | API, proporcionando acesso conveniente a cada back-end usando a mesma
    | sintaxe para todos. Aqui você pode definir uma conexão padrão.
    |
    */

    // Define qual conexão de fila será usada por padrão. O valor padrão é 'sync'.
    'default' => env('QUEUE_CONNECTION', 'sync'),

    /*
    |--------------------------------------------------------------------------
    | Conexões de Fila
    |--------------------------------------------------------------------------
    |
    | Aqui você pode configurar as informações de conexão para cada servidor que
    | é utilizado pela sua aplicação. Uma configuração padrão foi adicionada
    | para cada back-end fornecido pelo Laravel. Você pode adicionar mais.
    |
    | Drivers: "sync", "database", "beanstalkd", "sqs", "redis", "null"
    |
    */

    // Lista de conexões disponíveis para filas, cada uma com suas configurações específicas.
    'connections' => [

        // Conexão que executa os jobs imediatamente, sem fila.
        'sync' => [
            'driver' => 'sync',
        ],

        // Conexão que utiliza o banco de dados para armazenar jobs em uma tabela.
        'database' => [
            'driver' => 'database', // Tipo de driver utilizado.
            'table' => 'jobs', // Nome da tabela onde os jobs serão armazenados.
            'queue' => 'default', // Nome da fila padrão.
            'retry_after' => 90, // Tempo em segundos para tentar novamente um job falhado.
            'after_commit' => false, // Se o job deve ser executado após o commit da transação.
        ],

        // Conexão que utiliza o serviço Beanstalkd para filas.
        'beanstalkd' => [
            'driver' => 'beanstalkd', // Tipo de driver utilizado.
            'host' => 'localhost', // Endereço do servidor Beanstalkd.
            'queue' => 'default', // Nome da fila padrão.
            'retry_after' => 90, // Tempo em segundos para tentar novamente um job falhado.
            'block_for' => 0, // Tempo em segundos para bloquear esperando por jobs.
            'after_commit' => false, // Se o job deve ser executado após o commit da transação.
        ],

        // Conexão que utiliza o serviço SQS da AWS para filas.
        'sqs' => [
            'driver' => 'sqs', // Tipo de driver utilizado.
            'key' => env('AWS_ACCESS_KEY_ID'), // Chave de acesso AWS.
            'secret' => env('AWS_SECRET_ACCESS_KEY'), // Segredo de acesso AWS.
            'prefix' => env('SQS_PREFIX', 'https://sqs.us-east-1.amazonaws.com/your-account-id'), // Prefixo da URL da fila.
            'queue' => env('SQS_QUEUE', 'default'), // Nome da fila.
            'suffix' => env('SQS_SUFFIX'), // Sufixo da URL da fila.
            'region' => env('AWS_DEFAULT_REGION', 'us-east-1'), // Região AWS.
            'after_commit' => false, // Se o job deve ser executado após o commit da transação.
        ],

        // Conexão que utiliza o Redis para filas.
        'redis' => [
            'driver' => 'redis', // Tipo de driver utilizado.
            'connection' => 'default', // Nome da conexão Redis.
            'queue' => env('REDIS_QUEUE', 'default'), // Nome da fila.
            'retry_after' => 90, // Tempo em segundos para tentar novamente um job falhado.
            'block_for' => null, // Tempo em segundos para bloquear esperando por jobs.
            'after_commit' => false, // Se o job deve ser executado após o commit da transação.
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Jobs de Fila Falhados
    |--------------------------------------------------------------------------
    |
    | Estas opções configuram o comportamento do registro de jobs de fila falhados,
    | permitindo controlar qual banco de dados e tabela serão usados para armazenar
    | os jobs que falharam. Você pode alterá-los para qualquer banco/tabela desejado.
    |
    */

    // Configurações para armazenamento de jobs que falharam durante o processamento.
    'failed' => [
        'driver' => env('QUEUE_FAILED_DRIVER', 'database-uuids'), // Driver para jobs falhados.
        'database' => env('DB_CONNECTION', 'mysql'), // Banco de dados utilizado.
        'table' => 'failed_jobs', // Tabela onde os jobs falhados serão armazenados.
    ],

];
