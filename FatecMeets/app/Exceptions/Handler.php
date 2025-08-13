<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

// Classe responsável por lidar com exceções na aplicação
class Handler extends ExceptionHandler
{
    /**
     * Uma lista de tipos de exceção com seus respectivos níveis de log personalizados.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        // Adicione tipos de exceção e níveis de log personalizados aqui
    ];

    /**
     * Uma lista dos tipos de exceção que não são reportados.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        // Adicione tipos de exceção que não devem ser reportados
    ];

    /**
     * Uma lista dos inputs que nunca são armazenados na sessão em exceções de validação.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password', // Nunca armazene o campo de senha atual
        'password',         // Nunca armazene o campo de senha
        'password_confirmation', // Nunca armazene o campo de confirmação de senha
    ];

    /**
     * Registra os callbacks de tratamento de exceção para a aplicação.
     *
     * @return void
     */
    public function register()
    {
        // Callback para exceções reportáveis
        $this->reportable(function (Throwable $e) {
            // Adicione lógica personalizada para reportar exceções aqui
        });
    }
}

