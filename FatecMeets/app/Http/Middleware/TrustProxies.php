<?php

namespace App\Http\Middleware;

// Importa a classe Middleware TrustProxies do Laravel
use Illuminate\Http\Middleware\TrustProxies as Middleware;
// Importa a classe Request do Laravel
use Illuminate\Http\Request;

// Define a classe TrustProxies que estende a Middleware TrustProxies
class TrustProxies extends Middleware
{
    /**
     * Os proxies confiáveis para esta aplicação.
     *
     * @var array<int, string>|string|null
     */
    protected $proxies;

    /**
     * Os cabeçalhos que devem ser usados para detectar proxies.
     *
     * @var int
     */
    protected $headers =
        // Define os cabeçalhos que serão considerados para identificar proxies
        Request::HEADER_X_FORWARDED_FOR |      // Cabeçalho que informa o IP original do cliente
        Request::HEADER_X_FORWARDED_HOST |     // Cabeçalho que informa o host original solicitado pelo cliente
        Request::HEADER_X_FORWARDED_PORT |     // Cabeçalho que informa a porta original usada pelo cliente
        Request::HEADER_X_FORWARDED_PROTO |    // Cabeçalho que informa o protocolo (HTTP/HTTPS) original usado pelo cliente
        Request::HEADER_X_FORWARDED_AWS_ELB;   // Cabeçalho específico para balanceadores de carga da AWS
}

