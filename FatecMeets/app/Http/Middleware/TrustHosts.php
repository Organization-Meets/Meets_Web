<?php

namespace App\Http\Middleware;

// Importa a classe base TrustHosts do Laravel
use Illuminate\Http\Middleware\TrustHosts as Middleware;

// Define a classe TrustHosts que estende a classe base Middleware
class TrustHosts extends Middleware
{
    /**
     * Obtém os padrões de hosts que devem ser confiáveis.
     *
     * @return array<int, string|null> // Retorna um array de padrões de hosts confiáveis
     */
    public function hosts()
    {
        // Retorna um array contendo todos os subdomínios da URL da aplicação como confiáveis
        return [
            $this->allSubdomainsOfApplicationUrl(),
        ];
    }
}

