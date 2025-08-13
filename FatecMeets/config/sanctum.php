<?php

use Laravel\Sanctum\Sanctum;

return [

    /*
    |--------------------------------------------------------------------------
    | Domínios com Estado
    |--------------------------------------------------------------------------
    |
    | Requisições provenientes dos seguintes domínios/hosts receberão cookies
    | de autenticação de API com estado. Normalmente, estes devem incluir seus
    | domínios locais e de produção que acessam sua API via um SPA frontend.
    |
    | 'stateful' define os domínios que podem receber cookies de autenticação.
    | Utiliza a variável de ambiente SANCTUM_STATEFUL_DOMAINS ou, por padrão,
    | inclui localhost, 127.0.0.1, ::1 e o domínio atual da aplicação.
    */
    'stateful' => explode(',', env('SANCTUM_STATEFUL_DOMAINS', sprintf(
        '%s%s',
        'localhost,localhost:3000,127.0.0.1,127.0.0.1:8000,::1',
        Sanctum::currentApplicationUrlWithPort()
    ))),

    /*
    |--------------------------------------------------------------------------
    | Guards do Sanctum
    |--------------------------------------------------------------------------
    |
    | Este array contém os guards de autenticação que serão verificados quando
    | o Sanctum tentar autenticar uma requisição. Se nenhum destes guards
    | conseguir autenticar, o Sanctum usará o token bearer presente na
    | requisição para autenticação.
    |
    | 'guard' define quais guards de autenticação o Sanctum irá utilizar.
    | Por padrão, utiliza o guard 'web'.
    */
    'guard' => ['web'],

    /*
    |--------------------------------------------------------------------------
    | Minutos de Expiração
    |--------------------------------------------------------------------------
    |
    | Este valor controla o número de minutos até que um token emitido seja
    | considerado expirado. Se este valor for nulo, tokens de acesso pessoal
    | não expiram. Isso não altera o tempo de vida de sessões de primeira parte.
    |
    | 'expiration' define o tempo de expiração dos tokens de acesso pessoal.
    | Se for null, os tokens não expiram.
    */
    'expiration' => null,

    /*
    |--------------------------------------------------------------------------
    | Middleware do Sanctum
    |--------------------------------------------------------------------------
    |
    | Ao autenticar seu SPA de primeira parte com Sanctum, pode ser necessário
    | customizar alguns dos middlewares que o Sanctum usa ao processar a
    | requisição. Você pode alterar os middlewares listados abaixo conforme necessário.
    |
    | 'middleware' define os middlewares usados pelo Sanctum para processar
    | requisições, como verificação de CSRF e criptografia de cookies.
    */
    'middleware' => [
        // Middleware responsável por verificar o token CSRF nas requisições.
        'verify_csrf_token' => App\Http\Middleware\VerifyCsrfToken::class,
        // Middleware responsável por criptografar os cookies das requisições.
        'encrypt_cookies' => App\Http\Middleware\EncryptCookies::class,
    ],

];
