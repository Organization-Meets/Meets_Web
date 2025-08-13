<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Padrões de Autenticação
    |--------------------------------------------------------------------------
    |
    | Esta opção controla o "guard" de autenticação padrão e as opções de
    | redefinição de senha para sua aplicação. Você pode alterar esses
    | padrões conforme necessário, mas são um ótimo começo para a maioria
    | das aplicações.
    |
    */

    'defaults' => [
        // Define o guard padrão como 'web' e o grupo de senhas como 'users'
        'guard' => 'web',
        'passwords' => 'users',
    ],

    /*
    |--------------------------------------------------------------------------
    | Guards de Autenticação
    |--------------------------------------------------------------------------
    |
    | Aqui você pode definir todos os guards de autenticação para sua aplicação.
    | Uma configuração padrão já foi definida para você, utilizando armazenamento
    | de sessão e o provider de usuários Eloquent.
    |
    | Todos os drivers de autenticação possuem um provider de usuário. Isso define
    | como os usuários são recuperados do banco de dados ou outro mecanismo de
    | armazenamento utilizado para persistir os dados dos usuários.
    |
    | Suportado: "session"
    |
    */

    'guards' => [
        // Guard 'web' usa o driver de sessão e o provider 'users'
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Providers de Usuário
    |--------------------------------------------------------------------------
    |
    | Todos os drivers de autenticação possuem um provider de usuário. Isso define
    | como os usuários são recuperados do banco de dados ou outro mecanismo de
    | armazenamento utilizado para persistir os dados dos usuários.
    |
    | Se você tiver múltiplas tabelas ou modelos de usuários, pode configurar
    | múltiplas fontes que representam cada modelo/tabela. Essas fontes podem
    | ser atribuídas a guards extras que você definir.
    |
    | Suportado: "database", "eloquent"
    |
    */

    'providers' => [
        // Provider 'users' usa o driver Eloquent e o modelo User
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],

        // Exemplo de provider usando driver de banco de dados
        // 'users' => [
        //     'driver' => 'database',
        //     'table' => 'users',
        // ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Redefinição de Senhas
    |--------------------------------------------------------------------------
    |
    | Você pode especificar múltiplas configurações de redefinição de senha se
    | tiver mais de uma tabela ou modelo de usuário na aplicação e quiser ter
    | configurações separadas de redefinição de senha para cada tipo de usuário.
    |
    | O tempo de expiração é o número de minutos que cada token de redefinição
    | será considerado válido. Este recurso de segurança mantém os tokens com
    | vida curta para que tenham menos tempo de serem descobertos. Você pode
    | alterar conforme necessário.
    |
    */

    'passwords' => [
        // Configuração de redefinição de senha para o provider 'users'
        'users' => [
            'provider' => 'users',
            'table' => 'password_resets',
            'expire' => 60,    // Token válido por 60 minutos
            'throttle' => 60,  // Tempo mínimo entre solicitações de redefinição
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Tempo limite para confirmação de senha
    |--------------------------------------------------------------------------
    |
    | Aqui você pode definir a quantidade de segundos antes que a confirmação
    | de senha expire e o usuário seja solicitado a digitar a senha novamente
    | na tela de confirmação. Por padrão, o tempo limite é de três horas.
    |
    */

    'password_timeout' => 10800, // Tempo limite de confirmação de senha (em segundos)

];

