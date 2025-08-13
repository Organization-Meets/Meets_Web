<?php

namespace App\Providers;

// Importa o evento de registro de usuário
use Illuminate\Auth\Events\Registered;
// Importa o listener que envia o e-mail de verificação
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
// Importa a classe base para provedores de eventos
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
// Importa a facade de eventos do Laravel
use Illuminate\Support\Facades\Event;

// Provedor de eventos da aplicação
class EventServiceProvider extends ServiceProvider
{
    /**
     * Mapeamento de eventos para seus listeners na aplicação.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        // Quando o evento Registered for disparado, executa o listener SendEmailVerificationNotification
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Registra quaisquer eventos para sua aplicação.
     *
     * @return void
     */
    public function boot()
    {
        // Método chamado durante o boot do provedor, pode ser usado para registrar eventos manualmente
    }

    /**
     * Determina se eventos e listeners devem ser descobertos automaticamente.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        // Retorna falso para desabilitar a descoberta automática de eventos e listeners
        return false;
    }
}

