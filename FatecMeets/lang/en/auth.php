<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Linhas de idioma para autenticação
    |--------------------------------------------------------------------------
    |
    | As linhas de idioma abaixo são usadas durante a autenticação para várias
    | mensagens que precisamos exibir ao usuário. Você pode modificar essas
    | linhas de idioma conforme os requisitos da sua aplicação.
    |
    */

    // Mensagem exibida quando as credenciais fornecidas não correspondem aos registros
    'failed' => 'Essas credenciais não correspondem aos nossos registros.',

    // Mensagem exibida quando a senha fornecida está incorreta
    'password' => 'A senha fornecida está incorreta.',

    // Mensagem exibida quando há muitas tentativas de login em pouco tempo
    // :seconds será substituído pelo número de segundos que o usuário deve esperar
    'throttle' => 'Muitas tentativas de login. Por favor, tente novamente em :seconds segundos.',

];
