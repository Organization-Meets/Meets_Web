<?php

namespace App\Http\Middleware;

// Importa a classe base TrimStrings do Laravel
use Illuminate\Foundation\Http\Middleware\TrimStrings as Middleware;

/**
 * Middleware responsável por remover espaços em branco
 * do início e fim dos valores dos atributos das requisições.
 */
class TrimStrings extends Middleware
{
    /**
     * Os nomes dos atributos que não devem ser tratados (trim).
     *
     * @var array<int, string>
     */
    protected $except = [
        // Senha atual não será tratada
        'current_password',
        // Nova senha não será tratada
        'password',
        // Confirmação de senha não será tratada
        'password_confirmation',
    ];
}
