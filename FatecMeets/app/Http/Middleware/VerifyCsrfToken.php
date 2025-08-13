<?php

namespace App\Http\Middleware;

// Importa a classe base de verificação de CSRF do Laravel
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

/**
 * Middleware responsável por verificar o token CSRF nas requisições.
 * Protege a aplicação contra ataques do tipo Cross-Site Request Forgery.
 */
class VerifyCsrfToken extends Middleware
{
    /**
     * Os URIs que devem ser excluídos da verificação CSRF.
     *
     * @var array<int, string>
     */
    protected $except = [
        // Adicione aqui os caminhos (URIs) que não precisam de verificação CSRF.
        // Por exemplo: 'webhook/exemplo'
    ];
}

