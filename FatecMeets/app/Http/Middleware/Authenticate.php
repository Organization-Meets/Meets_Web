<?php

namespace App\Http\Middleware;

// Importa o middleware de autenticação padrão do Laravel
use Illuminate\Auth\Middleware\Authenticate as Middleware;

// Define a classe de middleware de autenticação
class Authenticate extends Middleware
{
    /**
     * Obtém o caminho para o qual o usuário deve ser redirecionado quando não está autenticado.
     *
     * @param  \Illuminate\Http\Request  $request  // O objeto da requisição HTTP
     * @return string|null  // Retorna a URL de redirecionamento ou null
     */
    protected function redirectTo($request)
    {
        // Verifica se a requisição não espera uma resposta em JSON
        if (! $request->expectsJson()) {
            // Retorna a rota de login para redirecionar o usuário não autenticado
            return route('login');
        }
        // Se espera JSON, não retorna nada (null), permitindo resposta padrão do Laravel
    }
}

