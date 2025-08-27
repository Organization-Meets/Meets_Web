<?php 

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

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
        $this->configureRateLimiting();

        $this->routes(function () {
            // Rotas API
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            // Rotas WEB
            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            // 🔥 Carrega automaticamente todas as rotas da pasta "routes/modules"
            foreach (glob(base_path('routes/modules/*.php')) as $routeFile) {
                Route::middleware('api')
                    ->prefix('api')
                    ->group($routeFile);
            }
        });
    }

    /**
     * Configura os limitadores de taxa para a aplicação.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
