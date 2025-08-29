<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
/**
 * Provedor de serviços de autenticação e autorização.
 * Responsável por registrar políticas de autorização e outros serviços relacionados.
 */
class AuthServiceProvider extends ServiceProvider
{
    /**
     * Mapeamento de modelos para suas respectivas políticas.
     *
     * @var array<class-string, class-string>
     * Exemplo: 'App\Models\Model' => 'App\Policies\ModelPolicy'
     * Adicione aqui os modelos e suas políticas para controle de autorização.
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Registra quaisquer serviços de autenticação/autorização.
     *
     * @return void
     * Este método é chamado durante o boot do provedor.
     * Aqui você pode registrar políticas ou outras regras de autorização.
     */
    public function boot()
    {
        $this->registerPolicies();

    }
}

