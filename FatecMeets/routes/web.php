<?php

use Illuminate\Support\Facades\Route;
Route::get('/', function () {
    return view('welcome');
});
// Usuário
require __DIR__.'/includes/UsuarioRoutes.php';
// Evento
require __DIR__.'/includes/EventoRoutes.php';
