<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

// Classe Kernel responsável por gerenciar os middlewares HTTP da aplicação
class Kernel extends HttpKernel
{
    /**
     * Pilha global de middlewares HTTP da aplicação.
     *
     * Esses middlewares são executados em toda requisição feita à aplicação.
     *
     * @var array<int, class-string|string>
     */
    protected $middleware = [
        // Middleware para confiar em hosts específicos (desabilitado por padrão)
        // \App\Http\Middleware\TrustHosts::class,
        // Middleware para confiar em proxies
        \App\Http\Middleware\TrustProxies::class,
        // Middleware para lidar com CORS (Cross-Origin Resource Sharing)
        \Illuminate\Http\Middleware\HandleCors::class,
        // Middleware para prevenir requisições durante manutenção
        \App\Http\Middleware\PreventRequestsDuringMaintenance::class,
        // Middleware para validar o tamanho máximo de POST
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        // Middleware para remover espaços em branco das strings
        \App\Http\Middleware\TrimStrings::class,
        // Middleware para converter strings vazias em null
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    /**
     * Grupos de middlewares das rotas da aplicação.
     *
     * @var array<string, array<int, class-string|string>>
     */
    protected $middlewareGroups = [
        'web' => [
            // Middleware para criptografar cookies
            \App\Http\Middleware\EncryptCookies::class,
            // Middleware para adicionar cookies à resposta
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            // Middleware para iniciar a sessão
            \Illuminate\Session\Middleware\StartSession::class,
            // Middleware para compartilhar erros da sessão com as views
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            // Middleware para verificar o token CSRF
            \App\Http\Middleware\VerifyCsrfToken::class,
            // Middleware para substituir bindings nas rotas
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            // Middleware para garantir requisições frontend stateful (desabilitado por padrão)
            // \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            // Middleware para limitar requisições (throttle)
            'throttle:api',
            // Middleware para substituir bindings nas rotas
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    /**
     * Middlewares individuais das rotas da aplicação.
     *
     * Esses middlewares podem ser atribuídos a grupos ou usados individualmente.
     *
     * @var array<string, class-string|string>
     */
    protected $routeMiddleware = [
        // Middleware de autenticação
        'auth' => \App\Http\Middleware\Authenticate::class,
        // Middleware de autenticação básica HTTP
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        // Middleware para autenticação de sessão
        'auth.session' => \Illuminate\Session\Middleware\AuthenticateSession::class,
        // Middleware para definir cabeçalhos de cache
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        // Middleware para autorização de usuários
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        // Middleware para redirecionar usuários autenticados
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        // Middleware para confirmação de senha
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
        // Middleware para validação de assinatura de URL
        'signed' => \App\Http\Middleware\ValidateSignature::class,
        // Middleware para limitar requisições
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        // Middleware para garantir que o e-mail foi verificado
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
    ];
}

