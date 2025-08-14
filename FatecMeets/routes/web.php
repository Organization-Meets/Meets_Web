<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;

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
Route::get('/usuarios/home', [UsuarioController::class, 'index'])->name('usuarios.index');
Route::get('/usuarios/create', [UsuarioController::class, 'create'])->name('usuarios.create');
Route::post('/usuarios', [UsuarioController::class, 'store'])->name('usuarios.store');
Route::get('/usuarios/{id}', [UsuarioController::class, 'show'])->name('usuarios.show');
Route::get('/usuarios/{id}/edit', [UsuarioController::class, 'edit'])->name('usuarios.edit');
Route::put('/usuarios/{id}', [UsuarioController::class, 'update'])->name('usuarios.update');
Route::delete('/usuarios/{id}', [UsuarioController::class, 'destroy'])->name('usuarios.destroy');
Route::get('/usuarios/perfil', [UsuarioController::class, 'perfil'])->name('usuarios.perfil');
Route::get('/usuarios/logout', [UsuarioController::class, 'logout'])->name('usuarios.logout');
Route::get('/usuarios/login', [UsuarioController::class, 'login'])->name('usuarios.login');
Route::get('/usuarios/loginForm', [UsuarioController::class, 'loginForm'])->name('usuarios.loginForm');