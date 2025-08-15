<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\EventoController;

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
Route::get('/home', function () {
    return view('welcome');
});
Route::get('/usuarios/home', [UsuarioController::class, 'index'])->name('usuarios.index');
Route::get('/usuarios/create', [UsuarioController::class, 'create'])->name('usuarios.create');
Route::post('/usuarios', [UsuarioController::class, 'store'])->name('usuarios.store');
Route::get('/usuarios/{id_usuario}', [UsuarioController::class, 'show'])
    ->where('id_usuario', '[0-9]+')
    ->name('usuarios.show');
Route::get('/usuarios/{id_usuario}/edit', [UsuarioController::class, 'edit'])->name('usuarios.edit');
Route::put('/usuarios/{id_usuario}', [UsuarioController::class, 'update'])->name('usuarios.update');
Route::delete('/usuarios/{id_usuario}', [UsuarioController::class, 'destroy'])->name('usuarios.destroy');
Route::get('/usuarios/perfil', [UsuarioController::class, 'perfil'])->name('usuarios.perfil');
Route::get('/usuarios/logout', [UsuarioController::class, 'logout'])->name('usuarios.logout');
Route::get('/usuarios/loginForm', [UsuarioController::class, 'loginForm'])->name('usuarios.loginForm');
Route::post('/usuarios/login', [UsuarioController::class, 'login'])->name('usuarios.login');
Route::get('/eventos', [EventoController::class, 'index'])->name('eventos.index');
Route::get('/eventos/create', [EventoController::class, 'create'])->name('eventos.create');
Route::post('/eventos', [EventoController::class, 'store'])->name('eventos.store');
Route::get('/eventos/{id_evento}', [EventoController::class, 'show'])->name('eventos.show');
Route::get('/eventos/{id_evento}/edit', [EventoController::class, 'edit'])->name('eventos.edit');
Route::put('/eventos/{id_evento}', [EventoController::class, 'update'])->name('eventos.update');
Route::delete('/eventos/{id_evento}', [EventoController::class, 'destroy'])->name('eventos.destroy');
