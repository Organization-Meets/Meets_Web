<?php

use Illuminate\Support\Facades\Facade;

return [

    /*
    |--------------------------------------------------------------------------
    | Nome da Aplicação
    |--------------------------------------------------------------------------
    |
    | Este valor é o nome da sua aplicação. Ele é utilizado quando o framework
    | precisa exibir o nome da aplicação em uma notificação ou em qualquer outro
    | local exigido pela aplicação ou seus pacotes.
    |
    */
    'name' => env('APP_NAME', 'Laravel'),

    /*
    |--------------------------------------------------------------------------
    | Ambiente da Aplicação
    |--------------------------------------------------------------------------
    |
    | Este valor determina o "ambiente" em que sua aplicação está rodando.
    | Isso pode influenciar como você prefere configurar vários serviços
    | utilizados pela aplicação. Defina isso no seu arquivo ".env".
    |
    */
    'env' => env('APP_ENV', 'production'),

    /*
    |--------------------------------------------------------------------------
    | Modo Debug da Aplicação
    |--------------------------------------------------------------------------
    |
    | Quando sua aplicação está em modo debug, mensagens de erro detalhadas com
    | rastreamento de pilha serão exibidas em cada erro que ocorrer. Se desativado,
    | uma página de erro genérica simples será mostrada.
    |
    */
    'debug' => (bool) env('APP_DEBUG', false),

    /*
    |--------------------------------------------------------------------------
    | URL da Aplicação
    |--------------------------------------------------------------------------
    |
    | Esta URL é usada pelo console para gerar URLs corretamente ao utilizar
    | a ferramenta de linha de comando Artisan. Defina isso para a raiz da
    | sua aplicação para que seja usada ao executar tarefas do Artisan.
    |
    */
    'url' => env('APP_URL', 'http://localhost'),

    // URL base para os assets da aplicação (CSS, JS, imagens, etc)
    'asset_url' => env('ASSET_URL'),

    /*
    |--------------------------------------------------------------------------
    | Fuso Horário da Aplicação
    |--------------------------------------------------------------------------
    |
    | Aqui você pode especificar o fuso horário padrão da sua aplicação, que
    | será usado pelas funções de data e hora do PHP. O padrão é UTC.
    |
    */
    'timezone' => 'UTC',

    /*
    |--------------------------------------------------------------------------
    | Configuração de Localidade da Aplicação
    |--------------------------------------------------------------------------
    |
    | A localidade da aplicação determina o idioma padrão que será usado pelo
    | provedor de serviços de tradução. Você pode definir para qualquer localidade
    | suportada pela aplicação.
    |
    */
    'locale' => 'en',

    /*
    |--------------------------------------------------------------------------
    | Localidade de Fallback da Aplicação
    |--------------------------------------------------------------------------
    |
    | A localidade de fallback determina o idioma a ser usado quando o atual não
    | estiver disponível. Altere para corresponder a qualquer pasta de idioma
    | fornecida pela sua aplicação.
    |
    */
    'fallback_locale' => 'en',

    /*
    |--------------------------------------------------------------------------
    | Localidade do Faker
    |--------------------------------------------------------------------------
    |
    | Esta localidade será usada pela biblioteca Faker PHP ao gerar dados falsos
    | para os seeds do banco de dados. Por exemplo, será usada para obter números
    | de telefone, endereços e mais informações localizadas.
    |
    */
    'faker_locale' => 'en_US',

    /*
    |--------------------------------------------------------------------------
    | Chave de Criptografia
    |--------------------------------------------------------------------------
    |
    | Esta chave é usada pelo serviço de criptografia do Illuminate e deve ser
    | definida como uma string aleatória de 32 caracteres. Caso contrário, os
    | dados criptografados não serão seguros. Faça isso antes de implantar!
    |
    */
    'key' => env('APP_KEY'),

    // Algoritmo de cifra utilizado para criptografia
    'cipher' => 'AES-256-CBC',

    /*
    |--------------------------------------------------------------------------
    | Driver do Modo de Manutenção
    |--------------------------------------------------------------------------
    |
    | Estas opções de configuração determinam o driver usado para gerenciar o
    | status do "modo de manutenção" do Laravel. O driver "cache" permite que
    | o modo de manutenção seja controlado em múltiplas máquinas.
    |
    | Drivers suportados: "file", "cache"
    |
    */
    'maintenance' => [
        'driver' => 'file',
        // 'store'  => 'redis',
    ],

    /*
    |--------------------------------------------------------------------------
    | Provedores de Serviço Autocarregados
    |--------------------------------------------------------------------------
    |
    | Os provedores de serviço listados aqui serão carregados automaticamente
    | em cada requisição à sua aplicação. Sinta-se livre para adicionar seus
    | próprios serviços para expandir funcionalidades.
    |
    */
    'providers' => [

        /*
         * Provedores de Serviço do Framework Laravel...
         */
        Illuminate\Auth\AuthServiceProvider::class,
        Illuminate\Broadcasting\BroadcastServiceProvider::class,
        Illuminate\Bus\BusServiceProvider::class,
        Illuminate\Cache\CacheServiceProvider::class,
        Illuminate\Foundation\Providers\ConsoleSupportServiceProvider::class,
        Illuminate\Cookie\CookieServiceProvider::class,
        Illuminate\Database\DatabaseServiceProvider::class,
        Illuminate\Encryption\EncryptionServiceProvider::class,
        Illuminate\Filesystem\FilesystemServiceProvider::class,
        Illuminate\Foundation\Providers\FoundationServiceProvider::class,
        Illuminate\Hashing\HashServiceProvider::class,
        Illuminate\Mail\MailServiceProvider::class,
        Illuminate\Notifications\NotificationServiceProvider::class,
        Illuminate\Pagination\PaginationServiceProvider::class,
        Illuminate\Pipeline\PipelineServiceProvider::class,
        Illuminate\Queue\QueueServiceProvider::class,
        Illuminate\Redis\RedisServiceProvider::class,
        Illuminate\Auth\Passwords\PasswordResetServiceProvider::class,
        Illuminate\Session\SessionServiceProvider::class,
        Illuminate\Translation\TranslationServiceProvider::class,
        Illuminate\Validation\ValidationServiceProvider::class,
        Illuminate\View\ViewServiceProvider::class,

        /*
         * Provedores de Serviço de Pacotes...
         */

        /*
         * Provedores de Serviço da Aplicação...
         */
        App\Providers\AppServiceProvider::class,
        App\Providers\AuthServiceProvider::class,
        // App\Providers\BroadcastServiceProvider::class,
        App\Providers\EventServiceProvider::class,
        App\Providers\RouteServiceProvider::class,

    ],

    /*
    |--------------------------------------------------------------------------
    | Apelidos de Classes
    |--------------------------------------------------------------------------
    |
    | Este array de apelidos de classes será registrado quando a aplicação
    | for iniciada. Sinta-se livre para registrar quantos quiser, pois os
    | apelidos são carregados de forma "preguiçosa" e não afetam a performance.
    |
    */
    'aliases' => Facade::defaultAliases()->merge([
        // 'ExampleClass' => App\Example\ExampleClass::class,
    ])->toArray(),

];

/*
|--------------------------------------------------------------------------
| Comentários Gerais
|--------------------------------------------------------------------------
|
| Este arquivo contém todas as principais configurações da sua aplicação Laravel,
| incluindo nome, ambiente, debug, URL, timezone, localidade, provedores de serviço,
| apelidos de classes, chave de criptografia, modo de manutenção e outros.
| Modifique conforme necessário para adaptar ao seu projeto.
|
*/
