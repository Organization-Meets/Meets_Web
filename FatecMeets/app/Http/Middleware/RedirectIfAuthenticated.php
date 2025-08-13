<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// Middleware responsável por redirecionar usuários autenticados
class RedirectIfAuthenticated
{
    /**
     * Manipula uma requisição recebida.
     *
     * @param  \Illuminate\Http\Request  $request  // Objeto da requisição HTTP
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next  // Próxima ação/middleware
     * @param  string|null  ...$guards  // Lista de guards de autenticação
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse  // Resposta HTTP ou redirecionamento
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        // Se não houver guards definidos, utiliza [null] como padrão
        $guards = empty($guards) ? [null] : $guards;

        // Percorre todos os guards informados
        foreach ($guards as $guard) {
            // Verifica se o usuário está autenticado com o guard atual
            if (Auth::guard($guard)->check()) {
                // Redireciona para a página inicial definida em RouteServiceProvider::HOME
                return redirect(RouteServiceProvider::HOME);
            }
        }

        // Se não estiver autenticado, continua o fluxo da requisição
        return $next($request);
    }
}

