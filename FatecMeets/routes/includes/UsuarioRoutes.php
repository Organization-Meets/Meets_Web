<?php
use App\Http\Controllers\UsuarioController;
Route::get('/usuarios', [UsuarioController::class, 'index'])->name('usuarios.index');
Route::get('/usuarios/create', [UsuarioController::class, 'create'])->name('usuarios.create');
Route::post('/usuarios', [UsuarioController::class, 'store'])->name('usuarios.store');
Route::get('/usuarios/{id_usuario}', [UsuarioController::class, 'show'])->name('usuarios.show');
Route::get('/usuarios/{id_usuario}/edit', [UsuarioController::class, 'edit'])->name('usuarios.edit');
Route::put('/usuarios/{id_usuario}', [UsuarioController::class, 'update'])->name('usuarios.update');
Route::delete('/usuarios/{id_usuario}', [UsuarioController::class, 'destroy'])->name('usuarios.destroy');
Route::get('/usuarios/perfil', [UsuarioController::class, 'perfil'])->name('usuarios.perfil');
Route::get('/usuarios/logout', [UsuarioController::class, 'logout'])->name('usuarios.logout');
Route::get('/usuarios/loginForm', [UsuarioController::class, 'loginForm'])->name('usuarios.loginForm');
Route::post('/usuarios/login', [UsuarioController::class, 'login'])->name('usuarios.login');
?>