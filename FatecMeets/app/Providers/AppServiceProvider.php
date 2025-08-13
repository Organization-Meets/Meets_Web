<?php

namespace App\Providers;

// Importa o ServiceProvider do Laravel
use Illuminate\Support\ServiceProvider;

// Esta classe é responsável por fornecer serviços para a aplicação
class AppServiceProvider extends ServiceProvider
{
    /**
     * Registra quaisquer serviços da aplicação.
     *
     * Este método é chamado durante o processo de registro dos provedores de serviço.
     * Aqui você pode vincular classes ou serviços ao contêiner de injeção de dependência.
     *
     * @return void
     */
    public function register()
    {
        // Você pode adicionar registros de serviços personalizados aqui
    }

    /**
     * Inicializa quaisquer serviços da aplicação.
     *
     * Este método é chamado após todos os provedores de serviço terem sido registrados.
     * Aqui você pode executar tarefas de inicialização, como configuração de eventos, rotas ou outros recursos.
     *
     * @return void
     */
    public function boot()
    {
        // Você pode adicionar inicializações personalizadas aqui
    }
}

