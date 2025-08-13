<?php

namespace App\Providers;

// Importa as classes necessárias para limitação de taxa, rotas e requisições
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

// Classe responsável por configurar as rotas da aplicação
class RouteServiceProvider extends ServiceProvider
{
    /**
     * O caminho para a rota "home" da sua aplicação.
     *
     * Normalmente, os usuários são redirecionados para cá após a autenticação.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define os bindings de modelos de rota, filtros de padrão e outras configurações de rota.
     *
     * @return void
     */
    public function boot()
    {
        // Configura a limitação de taxa para as rotas da aplicação
        $this->configureRateLimiting();

        // Define os grupos de rotas da aplicação
        $this->routes(function () {
            // Grupo de rotas para a API, usando o middleware 'api' e prefixo 'api'
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            // Grupo de rotas para a web, usando o middleware 'web'
            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }

    /**
     * Configura os limitadores de taxa para a aplicação.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        // Define um limitador de taxa para rotas da API
        RateLimiter::for('api', function (Request $request) {
            // Limita a 60 requisições por minuto por usuário autenticado ou por IP
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}

