<?php

/*
|--------------------------------------------------------------------------
| Crie a Aplicação
|--------------------------------------------------------------------------
|
| A primeira coisa que fazemos é criar uma nova instância da aplicação Laravel,
| que serve como a "cola" para todos os componentes do Laravel, e é o
| contêiner IoC para o sistema, vinculando todas as várias partes.
|
*/

$app = new Illuminate\Foundation\Application(
    $_ENV['APP_BASE_PATH'] ?? dirname(__DIR__)
);

/*
|--------------------------------------------------------------------------
| Vincule Interfaces Importantes
|--------------------------------------------------------------------------
|
| Em seguida, precisamos vincular algumas interfaces importantes ao contêiner
| para que possamos resolvê-las quando necessário. Os kernels servem as
| requisições recebidas para esta aplicação tanto da web quanto do CLI.
|
*/

$app->singleton(
    Illuminate\Contracts\Http\Kernel::class,
    App\Http\Kernel::class
); // Vincula o Kernel HTTP à aplicação como singleton

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Console\Kernel::class
); // Vincula o Kernel de Console à aplicação como singleton

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
); // Vincula o manipulador de exceções à aplicação como singleton

/*
|--------------------------------------------------------------------------
| Retorne a Aplicação
|--------------------------------------------------------------------------
|
| Este script retorna a instância da aplicação. A instância é fornecida ao
| script que a chamou para que possamos separar a construção das instâncias
| da execução real da aplicação e do envio das respostas.
|
*/

return $app; // Retorna a instância da aplicação Laravel

