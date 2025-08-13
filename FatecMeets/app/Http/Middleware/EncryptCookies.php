<?php

namespace App\Http\Middleware;

// Importa o middleware base responsável por criptografar cookies
use Illuminate\Cookie\Middleware\EncryptCookies as Middleware;

/**
 * Middleware para criptografar cookies.
 * 
 * Esta classe estende o middleware padrão do Laravel que criptografa automaticamente
 * todos os cookies enviados na resposta, exceto aqueles especificados no array $except.
 */
class EncryptCookies extends Middleware
{
    /**
     * Os nomes dos cookies que não devem ser criptografados.
     *
     * @var array<int, string>
     */
    protected $except = [
        // Adicione aqui os nomes dos cookies que não devem ser criptografados
    ];
}
