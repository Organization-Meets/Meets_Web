<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Mailer Padrão
    |--------------------------------------------------------------------------
    |
    | Esta opção controla o mailer padrão que será usado para enviar qualquer
    | mensagem de e-mail enviada pela sua aplicação. Mailers alternativos podem
    | ser configurados e usados conforme necessário; porém, este será usado por padrão.
    |
    */

    'default' => env('MAIL_MAILER', 'smtp'),

    /*
    |--------------------------------------------------------------------------
    | Configurações dos Mailers
    |--------------------------------------------------------------------------
    |
    | Aqui você pode configurar todos os mailers usados pela sua aplicação e suas
    | respectivas configurações. Vários exemplos já foram configurados para você,
    | e você pode adicionar outros conforme sua aplicação necessitar.
    |
    | O Laravel suporta diversos drivers de "transporte" de e-mail para envio.
    | Você deve especificar qual está usando para seus mailers abaixo. Sinta-se
    | livre para adicionar mailers adicionais conforme necessário.
    |
    | Suportados: "smtp", "sendmail", "mailgun", "ses",
    |             "postmark", "log", "array", "failover"
    |
    */

    'mailers' => [
        // Configuração do mailer SMTP
        'smtp' => [
            'transport' => 'smtp', // Tipo de transporte usado
            'host' => env('MAIL_HOST', 'smtp.mailgun.org'), // Endereço do servidor SMTP
            'port' => env('MAIL_PORT', 587), // Porta do servidor SMTP
            'encryption' => env('MAIL_ENCRYPTION', 'tls'), // Tipo de criptografia (tls/ssl)
            'username' => env('MAIL_USERNAME'), // Usuário para autenticação SMTP
            'password' => env('MAIL_PASSWORD'), // Senha para autenticação SMTP
            'timeout' => null, // Tempo limite da conexão (opcional)
            'local_domain' => env('MAIL_EHLO_DOMAIN'), // Domínio local usado no EHLO
        ],

        // Configuração do mailer SES (Amazon Simple Email Service)
        'ses' => [
            'transport' => 'ses',
        ],

        // Configuração do mailer Mailgun
        'mailgun' => [
            'transport' => 'mailgun',
        ],

        // Configuração do mailer Postmark
        'postmark' => [
            'transport' => 'postmark',
        ],

        // Configuração do mailer Sendmail
        'sendmail' => [
            'transport' => 'sendmail', // Tipo de transporte
            'path' => env('MAIL_SENDMAIL_PATH', '/usr/sbin/sendmail -bs -i'), // Caminho do executável sendmail
        ],

        // Configuração do mailer Log (salva os e-mails no log)
        'log' => [
            'transport' => 'log', // Tipo de transporte
            'channel' => env('MAIL_LOG_CHANNEL'), // Canal de log usado
        ],

        // Configuração do mailer Array (armazena e-mails em array, útil para testes)
        'array' => [
            'transport' => 'array',
        ],

        // Configuração do mailer Failover (tenta múltiplos mailers em caso de falha)
        'failover' => [
            'transport' => 'failover', // Tipo de transporte
            'mailers' => [
                'smtp', // Primeiro tenta SMTP
                'log',  // Se falhar, tenta Log
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Endereço Global "De"
    |--------------------------------------------------------------------------
    |
    | Você pode desejar que todos os e-mails enviados pela sua aplicação sejam
    | enviados do mesmo endereço. Aqui, você pode especificar um nome e endereço
    | que será usado globalmente para todos os e-mails enviados pela aplicação.
    |
    */

    'from' => [
        'address' => env('MAIL_FROM_ADDRESS', 'hello@example.com'), // Endereço de e-mail padrão do remetente
        'name' => env('MAIL_FROM_NAME', 'Example'), // Nome padrão do remetente
    ],

    /*
    |--------------------------------------------------------------------------
    | Configurações de E-mail Markdown
    |--------------------------------------------------------------------------
    |
    | Se você estiver usando renderização de e-mails baseada em Markdown, pode
    | configurar o tema e os caminhos dos componentes aqui, permitindo personalizar
    | o design dos e-mails. Ou, simplesmente, usar os padrões do Laravel!
    |
    */

    'markdown' => [
        'theme' => 'default', // Tema padrão para e-mails Markdown

        'paths' => [
            resource_path('views/vendor/mail'), // Caminho dos templates de e-mail Markdown
        ],
    ],

];
