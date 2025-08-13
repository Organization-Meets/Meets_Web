<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Driver de Hash Padrão
    |--------------------------------------------------------------------------
    |
    | Esta opção controla o driver de hash padrão que será usado para hashear
    | senhas na sua aplicação. Por padrão, o algoritmo bcrypt é utilizado;
    | no entanto, você pode modificar esta opção se desejar.
    |
    | Suportados: "bcrypt", "argon", "argon2id"
    |
    */
    'driver' => 'bcrypt', // Define o algoritmo padrão para hash de senhas.

    /*
    |--------------------------------------------------------------------------
    | Opções do Bcrypt
    |--------------------------------------------------------------------------
    |
    | Aqui você pode especificar as opções de configuração que devem ser usadas
    | quando as senhas forem hasheadas usando o algoritmo Bcrypt. Isso permite
    | controlar o tempo necessário para hashear a senha fornecida.
    |
    */
    'bcrypt' => [
        // 'rounds' define o número de rodadas do algoritmo bcrypt. Quanto maior, mais seguro e mais lento.
        'rounds' => env('BCRYPT_ROUNDS', 10),
    ],

    /*
    |--------------------------------------------------------------------------
    | Opções do Argon
    |--------------------------------------------------------------------------
    |
    | Aqui você pode especificar as opções de configuração que devem ser usadas
    | quando as senhas forem hasheadas usando o algoritmo Argon. Isso permite
    | controlar o tempo necessário para hashear a senha fornecida.
    |
    */
    'argon' => [
        // 'memory' define a quantidade de memória (em KB) usada pelo algoritmo Argon.
        'memory' => 65536,
        // 'threads' define o número de threads usadas no processo de hash.
        'threads' => 1,
        // 'time' define o número de iterações do algoritmo Argon.
        'time' => 4,
    ],

];
