<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Rotas Web
|--------------------------------------------------------------------------
|
| Aqui você pode registrar as rotas web para sua aplicação. Essas rotas
| são carregadas pelo RouteServiceProvider dentro de um grupo que contém
| o middleware "web". Agora crie algo incrível!
|
*/

// Define uma rota GET para a URL raiz ('/')
// Quando um usuário acessa '/', retorna a view 'welcome'
Route::get('/', function () {
    return view('welcome');
});
Route::get('/cadastrar', function () {
    return view('usuarios.create');
});
