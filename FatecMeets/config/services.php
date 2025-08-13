<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Serviços de Terceiros
    |--------------------------------------------------------------------------
    |
    | Este arquivo serve para armazenar as credenciais de serviços de terceiros,
    | como Mailgun, Postmark, AWS e outros. Ele fornece o local padrão para
    | esse tipo de informação, permitindo que pacotes encontrem facilmente
    | as credenciais dos diversos serviços utilizados.
    |
    */

    // Configurações do serviço Mailgun para envio de e-mails
    'mailgun' => [
        // Domínio utilizado na conta Mailgun
        'domain' => env('MAILGUN_DOMAIN'),
        // Chave secreta da API Mailgun
        'secret' => env('MAILGUN_SECRET'),
        // Endpoint da API Mailgun (padrão: api.mailgun.net)
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        // Esquema de conexão (padrão: https)
        'scheme' => 'https',
    ],

    // Configurações do serviço Postmark para envio de e-mails
    'postmark' => [
        // Token de autenticação da API Postmark
        'token' => env('POSTMARK_TOKEN'),
    ],

    // Configurações do serviço AWS SES para envio de e-mails
    'ses' => [
        // Chave de acesso AWS
        'key' => env('AWS_ACCESS_KEY_ID'),
        // Chave secreta AWS
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        // Região padrão do serviço SES (padrão: us-east-1)
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

];
