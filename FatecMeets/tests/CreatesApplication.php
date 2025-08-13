<?php

namespace Tests;

// Importa o contrato Kernel do Laravel, usado para inicializar a aplicação
use Illuminate\Contracts\Console\Kernel;

/**
 * Trait CreatesApplication
 * 
 * Este trait fornece um método para criar e inicializar a aplicação Laravel
 * durante os testes.
 */
trait CreatesApplication
{
    /**
     * Cria a aplicação.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        // Carrega o arquivo de bootstrap da aplicação Laravel, que retorna a instância da aplicação
        $app = require __DIR__.'/../bootstrap/app.php';

        // Inicializa (bootstrap) a aplicação usando o Kernel do console
        $app->make(Kernel::class)->bootstrap();

        // Retorna a instância da aplicação inicializada
        return $app;
    }
}

