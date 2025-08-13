<?php

namespace App\Providers;

// Importa a fachada Broadcast para definir rotas de broadcast
use Illuminate\Support\Facades\Broadcast;
// Importa a classe base ServiceProvider
use Illuminate\Support\ServiceProvider;

// Provedor de serviço responsável pela configuração do broadcast
class BroadcastServiceProvider extends ServiceProvider
{
    /**
     * Inicializa quaisquer serviços da aplicação.
     *
     * Este método é chamado durante o processo de bootstrapping da aplicação.
     * Aqui são definidas as rotas de broadcast e carregado o arquivo de canais.
     *
     * @return void
     */
    public function boot()
    {
        // Define as rotas necessárias para o broadcast (WebSockets, etc)
        Broadcast::routes();

        // Carrega o arquivo de definição dos canais de broadcast
        require base_path('routes/channels.php');
    }
}

