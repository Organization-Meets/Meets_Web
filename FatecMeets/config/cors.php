<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Configuração de Compartilhamento de Recursos de Origem Cruzada (CORS)
    |--------------------------------------------------------------------------
    |
    | Aqui você pode configurar suas definições para o compartilhamento de recursos
    | de origem cruzada, ou "CORS". Isso determina quais operações de origem cruzada
    | podem ser executadas em navegadores web. Sinta-se livre para ajustar essas
    | configurações conforme necessário.
    |
    | Para saber mais: https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS
    |
    */

    // Define os caminhos que aceitam requisições CORS. Exemplo: todas rotas que começam com 'api/' e 'sanctum/csrf-cookie'.
    'paths' => ['api/*', 'sanctum/csrf-cookie'],

    // Métodos HTTP permitidos para CORS. '*' permite todos os métodos (GET, POST, PUT, DELETE, etc).
    'allowed_methods' => ['*'],

    // Origens permitidas para acessar os recursos. '*' permite qualquer origem.
    'allowed_origins' => ['*'],

    // Padrões de origem permitidos usando expressões regulares. Array vazio significa nenhum padrão específico.
    'allowed_origins_patterns' => [],

    // Cabeçalhos permitidos nas requisições CORS. '*' permite todos os cabeçalhos.
    'allowed_headers' => ['*'],

    // Cabeçalhos que podem ser expostos para o navegador. Array vazio significa nenhum cabeçalho extra será exposto.
    'exposed_headers' => [],

    // Tempo máximo (em segundos) que a resposta CORS pode ser armazenada em cache pelo navegador. 0 significa sem cache.
    'max_age' => 0,

    // Define se as credenciais (cookies, autenticação HTTP, etc) são suportadas nas requisições CORS. false significa que não são suportadas.
    'supports_credentials' => false,

];
