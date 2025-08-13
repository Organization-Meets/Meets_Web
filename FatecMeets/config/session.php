<?php

use Illuminate\Support\Str;

return [

    /*
    |--------------------------------------------------------------------------
    | Driver de Sessão Padrão
    |--------------------------------------------------------------------------
    |
    | Esta opção controla o "driver" de sessão padrão que será usado nas
    | requisições. Por padrão, usamos o driver nativo leve, mas você pode
    | especificar qualquer outro driver disponível aqui.
    |
    | Suportados: "file", "cookie", "database", "apc",
    |             "memcached", "redis", "dynamodb", "array"
    |
    */
    'driver' => env('SESSION_DRIVER', 'file'),

    /*
    |--------------------------------------------------------------------------
    | Tempo de Vida da Sessão
    |--------------------------------------------------------------------------
    |
    | Aqui você pode especificar o número de minutos que a sessão pode ficar
    | ociosa antes de expirar. Se quiser que expire ao fechar o navegador,
    | defina essa opção.
    |
    */
    'lifetime' => env('SESSION_LIFETIME', 120),

    // Define se a sessão expira ao fechar o navegador
    'expire_on_close' => false,

    /*
    |--------------------------------------------------------------------------
    | Criptografia da Sessão
    |--------------------------------------------------------------------------
    |
    | Esta opção permite especificar se todos os dados da sessão devem ser
    | criptografados antes de serem armazenados. A criptografia será feita
    | automaticamente pelo Laravel.
    |
    */
    'encrypt' => false,

    /*
    |--------------------------------------------------------------------------
    | Localização dos Arquivos de Sessão
    |--------------------------------------------------------------------------
    |
    | Ao usar o driver de sessão nativo, precisamos de um local para armazenar
    | os arquivos de sessão. Um padrão já foi definido, mas você pode alterar.
    | Esta opção é usada apenas para sessões em arquivo.
    |
    */
    'files' => storage_path('framework/sessions'),

    /*
    |--------------------------------------------------------------------------
    | Conexão do Banco de Dados para Sessão
    |--------------------------------------------------------------------------
    |
    | Ao usar os drivers "database" ou "redis", você pode especificar a conexão
    | que será usada para gerenciar essas sessões. Deve corresponder a uma
    | conexão nas opções de configuração do banco de dados.
    |
    */
    'connection' => env('SESSION_CONNECTION'),

    /*
    |--------------------------------------------------------------------------
    | Tabela do Banco de Dados para Sessão
    |--------------------------------------------------------------------------
    |
    | Ao usar o driver de sessão "database", você pode especificar a tabela que
    | será usada para gerenciar as sessões. Um padrão já foi definido, mas
    | você pode alterar conforme necessário.
    |
    */
    'table' => 'sessions',

    /*
    |--------------------------------------------------------------------------
    | Store de Cache para Sessão
    |--------------------------------------------------------------------------
    |
    | Ao usar um backend de sessão baseado em cache, você pode listar o store
    | de cache que será usado para essas sessões. O valor deve corresponder a
    | um dos stores de cache configurados na aplicação.
    |
    | Afeta: "apc", "dynamodb", "memcached", "redis"
    |
    */
    'store' => env('SESSION_STORE'),

    /*
    |--------------------------------------------------------------------------
    | Loteria de Limpeza de Sessão
    |--------------------------------------------------------------------------
    |
    | Alguns drivers de sessão precisam limpar manualmente o local de
    | armazenamento para remover sessões antigas. Aqui estão as chances de
    | isso acontecer em uma requisição. Por padrão, 2 em 100.
    |
    */
    'lottery' => [2, 100],

    /*
    |--------------------------------------------------------------------------
    | Nome do Cookie de Sessão
    |--------------------------------------------------------------------------
    |
    | Aqui você pode alterar o nome do cookie usado para identificar uma
    | instância de sessão pelo ID. O nome será usado sempre que um novo
    | cookie de sessão for criado pelo framework para cada driver.
    |
    */
    'cookie' => env(
        'SESSION_COOKIE',
        Str::slug(env('APP_NAME', 'laravel'), '_').'_session'
    ),

    /*
    |--------------------------------------------------------------------------
    | Caminho do Cookie de Sessão
    |--------------------------------------------------------------------------
    |
    | O caminho do cookie de sessão determina para qual caminho o cookie será
    | considerado disponível. Normalmente, será o caminho raiz da aplicação,
    | mas você pode alterar se necessário.
    |
    */
    'path' => '/',

    /*
    |--------------------------------------------------------------------------
    | Domínio do Cookie de Sessão
    |--------------------------------------------------------------------------
    |
    | Aqui você pode alterar o domínio do cookie usado para identificar uma
    | sessão na aplicação. Isso determina para quais domínios o cookie estará
    | disponível. Um padrão já foi definido.
    |
    */
    'domain' => env('SESSION_DOMAIN'),

    /*
    |--------------------------------------------------------------------------
    | Cookies Apenas HTTPS
    |--------------------------------------------------------------------------
    |
    | Definindo esta opção como true, os cookies de sessão só serão enviados
    | ao servidor se o navegador tiver uma conexão HTTPS. Isso impede que o
    | cookie seja enviado quando não for seguro.
    |
    */
    'secure' => env('SESSION_SECURE_COOKIE'),

    /*
    |--------------------------------------------------------------------------
    | Acesso Apenas HTTP
    |--------------------------------------------------------------------------
    |
    | Definindo este valor como true, o JavaScript não poderá acessar o valor
    | do cookie, que só será acessível via protocolo HTTP.
    |
    */
    'http_only' => true,

    /*
    |--------------------------------------------------------------------------
    | Cookies Same-Site
    |--------------------------------------------------------------------------
    |
    | Esta opção determina como os cookies se comportam em requisições
    | cross-site, podendo ser usada para mitigar ataques CSRF. O padrão é
    | "lax", pois é um valor seguro.
    |
    | Suportados: "lax", "strict", "none", null
    |
    */
    'same_site' => 'lax',

];

/*
    Explicação dos parâmetros:
    - driver: Define o tipo de armazenamento da sessão.
    - lifetime: Tempo em minutos que a sessão permanece ativa.
    - expire_on_close: Se true, a sessão expira ao fechar o navegador.
    - encrypt: Se true, os dados da sessão são criptografados.
    - files: Caminho para armazenar arquivos de sessão (driver "file").
    - connection: Conexão do banco de dados para sessões (drivers "database"/"redis").
    - table: Nome da tabela para sessões (driver "database").
    - store: Store de cache para sessões (drivers baseados em cache).
    - lottery: Probabilidade de limpar sessões antigas.
    - cookie: Nome do cookie de sessão.
    - path: Caminho do cookie.
    - domain: Domínio do cookie.
    - secure: Se true, cookie só é enviado via HTTPS.
    - http_only: Se true, cookie só acessível via HTTP.
    - same_site: Política de Same-Site para cookies.
*/
