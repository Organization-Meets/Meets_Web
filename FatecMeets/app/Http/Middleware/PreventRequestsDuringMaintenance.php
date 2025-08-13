<?php

namespace App\Http\Middleware;

// Importa a classe base do middleware de prevenção durante manutenção
use Illuminate\Foundation\Http\Middleware\PreventRequestsDuringMaintenance as Middleware;

/**
 * Middleware para prevenir requisições durante o modo de manutenção.
 * Estende a classe base do Laravel responsável por bloquear acessos enquanto o sistema está em manutenção.
 */
class PreventRequestsDuringMaintenance extends Middleware
{
    /**
     * Os URIs que devem ser acessíveis enquanto o modo de manutenção está ativado.
     *
     * @var array<int, string>
     */
    protected $except = [
        // Adicione aqui os caminhos que devem ser liberados durante a manutenção
    ];
}

