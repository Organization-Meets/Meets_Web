<?php
use App\Http\Controllers\UsuarioController;
Route::get('/usuarios', [UsuarioController::class, 'index'])->name('usuarios.index');
Route::get('/usuarios/create', [UsuarioController::class, 'create'])->name('usuarios.create');
Route::post('/usuarios', [UsuarioController::class, 'store'])->name('usuarios.store');
Route::get('/usuarios/{id_usuario}', [UsuarioController::class, 'show'])
    ->where('id_usuario', '[0-9]+')
    ->name('usuarios.show');
Route::get('/usuarios/{id_usuario}/edit', [UsuarioController::class, 'edit'])->where('id_usuario', '[0-9]+')->name('usuarios.edit');
Route::put('/usuarios/{id_usuario}', [UsuarioController::class, 'update'])->where('id_usuario', '[0-9]+')->name('usuarios.update');
Route::delete('/usuarios/{id_usuario}', [UsuarioController::class, 'destroy'])->where('id_usuario', '[0-9]+')->name('usuarios.destroy');
Route::get('/usuarios/perfil', [UsuarioController::class, 'perfil'])->name('usuarios.perfil');
Route::get('/usuarios/logout', [UsuarioController::class, 'logout'])->name('usuarios.logout');
Route::get('/usuarios/loginForm', [UsuarioController::class, 'loginForm'])->name('usuario.loginForm');
Route::post('/usuarios/login', [UsuarioController::class, 'login'])->name('usuario.login');
?>