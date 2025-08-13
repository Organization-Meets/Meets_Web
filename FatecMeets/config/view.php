<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Caminhos de armazenamento das views
    |--------------------------------------------------------------------------
    |
    | A maioria dos sistemas de template carrega os templates do disco. Aqui você pode
    | especificar um array de caminhos que devem ser verificados para suas views.
    | O caminho padrão das views do Laravel já foi registrado para você.
    |
    */
    'paths' => [
        // Define os diretórios onde o Laravel irá procurar pelos arquivos de views.
        resource_path('views'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Caminho para views compiladas
    |--------------------------------------------------------------------------
    |
    | Esta opção determina onde todos os templates Blade compilados serão armazenados
    | para sua aplicação. Normalmente, isso fica dentro do diretório storage.
    | Porém, como de costume, você pode alterar este valor livremente.
    |
    */
    'compiled' => env(
        // Define o caminho onde os arquivos Blade compilados serão salvos.
        'VIEW_COMPILED_PATH',
        realpath(storage_path('framework/views'))
    ),

];
