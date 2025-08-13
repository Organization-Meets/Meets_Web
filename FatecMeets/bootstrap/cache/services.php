<?php 
// Este arquivo retorna um array de configuração de provedores de serviços do Laravel.
// Ele é usado para gerenciar o carregamento dos provedores, tanto de forma ansiosa (eager) quanto adiada (deferred).

return array (
  // 'providers': Lista de todos os provedores de serviços registrados na aplicação.
  'providers' => 
  array (
    // Provedores do núcleo do Laravel e de pacotes externos.
    0 => 'Illuminate\\Auth\\AuthServiceProvider', // Provedor de autenticação
    1 => 'Illuminate\\Broadcasting\\BroadcastServiceProvider', // Provedor de broadcast (transmissão de eventos)
    2 => 'Illuminate\\Bus\\BusServiceProvider', // Provedor de filas de tarefas (bus)
    3 => 'Illuminate\\Cache\\CacheServiceProvider', // Provedor de cache
    4 => 'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider', // Provedor de comandos do console
    5 => 'Illuminate\\Cookie\\CookieServiceProvider', // Provedor de cookies
    6 => 'Illuminate\\Database\\DatabaseServiceProvider', // Provedor de banco de dados
    7 => 'Illuminate\\Encryption\\EncryptionServiceProvider', // Provedor de criptografia
    8 => 'Illuminate\\Filesystem\\FilesystemServiceProvider', // Provedor de sistema de arquivos
    9 => 'Illuminate\\Foundation\\Providers\\FoundationServiceProvider', // Provedor da fundação do framework
    10 => 'Illuminate\\Hashing\\HashServiceProvider', // Provedor de hash
    11 => 'Illuminate\\Mail\\MailServiceProvider', // Provedor de e-mail
    12 => 'Illuminate\\Notifications\\NotificationServiceProvider', // Provedor de notificações
    13 => 'Illuminate\\Pagination\\PaginationServiceProvider', // Provedor de paginação
    14 => 'Illuminate\\Pipeline\\PipelineServiceProvider', // Provedor de pipeline
    15 => 'Illuminate\\Queue\\QueueServiceProvider', // Provedor de filas
    16 => 'Illuminate\\Redis\\RedisServiceProvider', // Provedor de Redis
    17 => 'Illuminate\\Auth\\Passwords\\PasswordResetServiceProvider', // Provedor de redefinição de senha
    18 => 'Illuminate\\Session\\SessionServiceProvider', // Provedor de sessão
    19 => 'Illuminate\\Translation\\TranslationServiceProvider', // Provedor de tradução
    20 => 'Illuminate\\Validation\\ValidationServiceProvider', // Provedor de validação
    21 => 'Illuminate\\View\\ViewServiceProvider', // Provedor de views
    22 => 'Laravel\\Sail\\SailServiceProvider', // Provedor do Laravel Sail
    23 => 'Laravel\\Sanctum\\SanctumServiceProvider', // Provedor do Laravel Sanctum
    24 => 'Laravel\\Tinker\\TinkerServiceProvider', // Provedor do Laravel Tinker
    25 => 'Carbon\\Laravel\\ServiceProvider', // Provedor do Carbon (datas)
    26 => 'NunoMaduro\\Collision\\Adapters\\Laravel\\CollisionServiceProvider', // Provedor do Collision (debug)
    27 => 'Termwind\\Laravel\\TermwindServiceProvider', // Provedor do Termwind (terminal)
    28 => 'Spatie\\LaravelIgnition\\IgnitionServiceProvider', // Provedor do Ignition (erros)
    29 => 'App\\Providers\\AppServiceProvider', // Provedor de serviços da aplicação
    30 => 'App\\Providers\\AuthServiceProvider', // Provedor de autenticação da aplicação
    31 => 'App\\Providers\\EventServiceProvider', // Provedor de eventos da aplicação
    32 => 'App\\Providers\\RouteServiceProvider', // Provedor de rotas da aplicação
  ),
  // 'eager': Provedores que são carregados imediatamente na inicialização da aplicação.
  'eager' => 
  array (
    0 => 'Illuminate\\Auth\\AuthServiceProvider', // Autenticação
    1 => 'Illuminate\\Cookie\\CookieServiceProvider', // Cookies
    2 => 'Illuminate\\Database\\DatabaseServiceProvider', // Banco de dados
    3 => 'Illuminate\\Encryption\\EncryptionServiceProvider', // Criptografia
    4 => 'Illuminate\\Filesystem\\FilesystemServiceProvider', // Sistema de arquivos
    5 => 'Illuminate\\Foundation\\Providers\\FoundationServiceProvider', // Fundação do framework
    6 => 'Illuminate\\Notifications\\NotificationServiceProvider', // Notificações
    7 => 'Illuminate\\Pagination\\PaginationServiceProvider', // Paginação
    8 => 'Illuminate\\Session\\SessionServiceProvider', // Sessão
    9 => 'Illuminate\\View\\ViewServiceProvider', // Views
    10 => 'Laravel\\Sanctum\\SanctumServiceProvider', // Sanctum
    11 => 'Carbon\\Laravel\\ServiceProvider', // Carbon
    12 => 'NunoMaduro\\Collision\\Adapters\\Laravel\\CollisionServiceProvider', // Collision
    13 => 'Termwind\\Laravel\\TermwindServiceProvider', // Termwind
    14 => 'Spatie\\LaravelIgnition\\IgnitionServiceProvider', // Ignition
    15 => 'App\\Providers\\AppServiceProvider', // Serviços da aplicação
    16 => 'App\\Providers\\AuthServiceProvider', // Autenticação da aplicação
    17 => 'App\\Providers\\EventServiceProvider', // Eventos da aplicação
    18 => 'App\\Providers\\RouteServiceProvider', // Rotas da aplicação
  ),
  // 'deferred': Serviços que são carregados apenas quando necessários.
  'deferred' => 
  array (
    // Chave: nome do serviço, Valor: provedor responsável
    'Illuminate\\Broadcasting\\BroadcastManager' => 'Illuminate\\Broadcasting\\BroadcastServiceProvider', // Gerenciador de broadcast
    'Illuminate\\Contracts\\Broadcasting\\Factory' => 'Illuminate\\Broadcasting\\BroadcastServiceProvider', // Fábrica de broadcast
    'Illuminate\\Contracts\\Broadcasting\\Broadcaster' => 'Illuminate\\Broadcasting\\BroadcastServiceProvider', // Broadcaster
    'Illuminate\\Bus\\Dispatcher' => 'Illuminate\\Bus\\BusServiceProvider', // Despachante de filas
    'Illuminate\\Contracts\\Bus\\Dispatcher' => 'Illuminate\\Bus\\BusServiceProvider', // Contrato de despachante
    'Illuminate\\Contracts\\Bus\\QueueingDispatcher' => 'Illuminate\\Bus\\BusServiceProvider', // Contrato de despachante de filas
    'Illuminate\\Bus\\BatchRepository' => 'Illuminate\\Bus\\BusServiceProvider', // Repositório de lotes
    'Illuminate\\Bus\\DatabaseBatchRepository' => 'Illuminate\\Bus\\BusServiceProvider', // Repositório de lotes no banco de dados
    'cache' => 'Illuminate\\Cache\\CacheServiceProvider', // Cache
    'cache.store' => 'Illuminate\\Cache\\CacheServiceProvider', // Armazenamento de cache
    'cache.psr6' => 'Illuminate\\Cache\\CacheServiceProvider', // Cache PSR-6
    'memcached.connector' => 'Illuminate\\Cache\\CacheServiceProvider', // Conector Memcached
    'Illuminate\\Cache\\RateLimiter' => 'Illuminate\\Cache\\CacheServiceProvider', // Limitador de taxa
    // ... (demais serviços adiados seguem o mesmo padrão)
    // Muitos comandos do console, serviços de fila, migração, validação, tradução, etc.
  ),
  // 'when': Define quando os provedores adiados devem ser carregados.
  'when' => 
  array (
    'Illuminate\\Broadcasting\\BroadcastServiceProvider' => 
    array (
      // Carregado quando algum serviço de broadcast é solicitado
    ),
    'Illuminate\\Bus\\BusServiceProvider' => 
    array (
      // Carregado quando algum serviço de filas é solicitado
    ),
    'Illuminate\\Cache\\CacheServiceProvider' => 
    array (
      // Carregado quando algum serviço de cache é solicitado
    ),
    'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider' => 
    array (
      // Carregado quando comandos do console são solicitados
    ),
    'Illuminate\\Hashing\\HashServiceProvider' => 
    array (
      // Carregado quando serviço de hash é solicitado
    ),
    'Illuminate\\Mail\\MailServiceProvider' => 
    array (
      // Carregado quando serviço de e-mail é solicitado
    ),
    'Illuminate\\Pipeline\\PipelineServiceProvider' => 
    array (
      // Carregado quando serviço de pipeline é solicitado
    ),
    'Illuminate\\Queue\\QueueServiceProvider' => 
    array (
      // Carregado quando serviço de filas é solicitado
    ),
    'Illuminate\\Redis\\RedisServiceProvider' => 
    array (
      // Carregado quando serviço de Redis é solicitado
    ),
    'Illuminate\\Auth\\Passwords\\PasswordResetServiceProvider' => 
    array (
      // Carregado quando serviço de redefinição de senha é solicitado
    ),
    'Illuminate\\Translation\\TranslationServiceProvider' => 
    array (
      // Carregado quando serviço de tradução é solicitado
    ),
    'Illuminate\\Validation\\ValidationServiceProvider' => 
    array (
      // Carregado quando serviço de validação é solicitado
    ),
    'Laravel\\Sail\\SailServiceProvider' => 
    array (
      // Carregado quando comandos do Sail são solicitados
    ),
    'Laravel\\Tinker\\TinkerServiceProvider' => 
    array (
      // Carregado quando comando Tinker é solicitado
    ),
  ),
);
