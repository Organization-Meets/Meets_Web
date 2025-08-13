<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Rotas do Console
|--------------------------------------------------------------------------
|
| Este arquivo é onde você pode definir todos os seus comandos de console
| baseados em Closure. Cada Closure está vinculada a uma instância de comando,
| permitindo uma abordagem simples para interagir com os métodos de IO de cada comando.
|
*/

// Define um comando chamado 'inspire' no Artisan.
// Quando executado, exibe uma citação inspiradora no console.
Artisan::command('inspire', function () {
    // Exibe uma mensagem comentada com uma citação inspiradora.
    $this->comment(Inspiring::quote());
})->purpose('Exibir uma citação inspiradora');

