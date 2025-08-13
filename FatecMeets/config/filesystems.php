<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Disco de Sistema de Arquivos Padrão
    |--------------------------------------------------------------------------
    |
    | Aqui você pode especificar o disco de sistema de arquivos padrão que deve ser
    | usado pelo framework. O disco "local", assim como vários discos baseados em
    | nuvem, estão disponíveis para sua aplicação. Apenas armazene!
    |
    */

    'default' => env('FILESYSTEM_DISK', 'local'), // Define o disco padrão, usando variável de ambiente ou 'local'

    /*
    |--------------------------------------------------------------------------
    | Discos de Sistema de Arquivos
    |--------------------------------------------------------------------------
    |
    | Aqui você pode configurar quantos discos de sistema de arquivos desejar, e pode
    | até mesmo configurar múltiplos discos do mesmo driver. Os valores padrão foram
    | definidos para cada driver como exemplo dos valores necessários.
    |
    | Drivers suportados: "local", "ftp", "sftp", "s3"
    |
    */

    'disks' => [

        // Disco local, armazena arquivos no diretório storage/app
        'local' => [
            'driver' => 'local', // Tipo de driver
            'root' => storage_path('app'), // Caminho raiz dos arquivos
            'throw' => false, // Não lança exceções em erros
        ],

        // Disco público, armazena arquivos acessíveis publicamente
        'public' => [
            'driver' => 'local', // Tipo de driver
            'root' => storage_path('app/public'), // Caminho raiz dos arquivos públicos
            'url' => env('APP_URL').'/storage', // URL pública para acessar os arquivos
            'visibility' => 'public', // Visibilidade dos arquivos
            'throw' => false, // Não lança exceções em erros
        ],

        // Disco S3, armazena arquivos em um bucket AWS S3
        's3' => [
            'driver' => 's3', // Tipo de driver
            'key' => env('AWS_ACCESS_KEY_ID'), // Chave de acesso AWS
            'secret' => env('AWS_SECRET_ACCESS_KEY'), // Segredo de acesso AWS
            'region' => env('AWS_DEFAULT_REGION'), // Região do bucket
            'bucket' => env('AWS_BUCKET'), // Nome do bucket
            'url' => env('AWS_URL'), // URL do bucket
            'endpoint' => env('AWS_ENDPOINT'), // Endpoint customizado
            'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false), // Usa endpoint no estilo de caminho
            'throw' => false, // Não lança exceções em erros
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Links Simbólicos
    |--------------------------------------------------------------------------
    |
    | Aqui você pode configurar os links simbólicos que serão criados quando o
    | comando Artisan `storage:link` for executado. As chaves do array devem ser
    | os locais dos links e os valores devem ser seus destinos.
    |
    */

    'links' => [
        public_path('storage') => storage_path('app/public'), // Cria link simbólico do storage público para o diretório público
    ],

];
