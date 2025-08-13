<?php 
// Este arquivo retorna um array associativo contendo informações sobre os pacotes instalados no projeto Laravel.
// Cada chave do array representa o nome de um pacote, e o valor é outro array com informações sobre provedores e aliases.

return array (
  // Pacote laravel/sail: fornece ambiente de desenvolvimento Docker para Laravel.
  'laravel/sail' => 
  array (
    // Provedores de serviço registrados pelo pacote.
    'providers' => 
    array (
      0 => 'Laravel\\Sail\\SailServiceProvider', // Provedor de serviço do Sail.
    ),
  ),
  // Pacote laravel/sanctum: fornece autenticação via tokens para APIs.
  'laravel/sanctum' => 
  array (
    'providers' => 
    array (
      0 => 'Laravel\\Sanctum\\SanctumServiceProvider', // Provedor de serviço do Sanctum.
    ),
  ),
  // Pacote laravel/tinker: permite executar comandos interativos no Laravel.
  'laravel/tinker' => 
  array (
    'providers' => 
    array (
      0 => 'Laravel\\Tinker\\TinkerServiceProvider', // Provedor de serviço do Tinker.
    ),
  ),
  // Pacote nesbot/carbon: manipulação de datas e horários.
  'nesbot/carbon' => 
  array (
    'providers' => 
    array (
      0 => 'Carbon\\Laravel\\ServiceProvider', // Provedor de serviço do Carbon.
    ),
  ),
  // Pacote nunomaduro/collision: fornece relatórios de erros detalhados para desenvolvimento.
  'nunomaduro/collision' => 
  array (
    'providers' => 
    array (
      0 => 'NunoMaduro\\Collision\\Adapters\\Laravel\\CollisionServiceProvider', // Provedor de serviço do Collision.
    ),
  ),
  // Pacote nunomaduro/termwind: permite criar interfaces de terminal estilizadas.
  'nunomaduro/termwind' => 
  array (
    'providers' => 
    array (
      0 => 'Termwind\\Laravel\\TermwindServiceProvider', // Provedor de serviço do Termwind.
    ),
  ),
  // Pacote spatie/laravel-ignition: fornece ferramentas de depuração para Laravel.
  'spatie/laravel-ignition' => 
  array (
    // Aliases registrados pelo pacote.
    'aliases' => 
    array (
      'Flare' => 'Spatie\\LaravelIgnition\\Facades\\Flare', // Alias para a fachada Flare.
    ),
    'providers' => 
    array (
      0 => 'Spatie\\LaravelIgnition\\IgnitionServiceProvider', // Provedor de serviço do Ignition.
    ),
  ),
);