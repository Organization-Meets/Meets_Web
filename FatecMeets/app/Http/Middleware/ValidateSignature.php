<?php

namespace App\Http\Middleware;

// Importa o middleware ValidateSignature do Laravel
use Illuminate\Routing\Middleware\ValidateSignature as Middleware;

/**
 * Middleware para validar assinaturas de URLs.
 * Garante que os links assinados não sejam modificados, exceto pelos parâmetros ignorados.
 */
class ValidateSignature extends Middleware
{
    /**
     * Os nomes dos parâmetros da query string que devem ser ignorados.
     * 
     * @var array<int, string>
     * 
     * Por exemplo, parâmetros de rastreamento como 'utm_source' não afetam a validação da assinatura.
     * Adicione aqui os nomes dos parâmetros que não devem ser considerados na verificação da assinatura.
     */
    protected $except = [
        // 'fbclid',        // Parâmetro do Facebook Click Identifier
        // 'utm_campaign',  // Parâmetro de campanha do Google Analytics
        // 'utm_content',   // Parâmetro de conteúdo do Google Analytics
        // 'utm_medium',    // Parâmetro de meio do Google Analytics
        // 'utm_source',    // Parâmetro de origem do Google Analytics
        // 'utm_term',      // Parâmetro de termo de busca do Google Analytics
    ];
}

