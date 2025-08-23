<?php

use Illuminate\Support\Facades\Route;
// Usuário
require __DIR__.'/includes/UsuarioRoutes.php';
// Evento
require __DIR__.'/includes/EventoRoutes.php';

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::redirect('/inicio', '/')->name('inicio');