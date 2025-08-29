<?php
use Illuminate\Support\Facades\Auth;

Route::prefix('usuarios')->group(function () {
    Route::get('/', [UsuarioController::class, 'index'])->name('usuarios.index');
    Route::get('/{id}', [UsuarioController::class, 'show'])->name('usuarios.show');
    Route::post('/', [UsuarioController::class, 'store'])->name('usuarios.store');
    Route::put('/{id}', [UsuarioController::class, 'update'])->name('usuarios.update');
    Route::delete('/{id}', [UsuarioController::class, 'destroy'])->name('usuarios.destroy');

    Route::post('/{id}/enviar-token', [UsuarioController::class, 'enviarToken'])->name('usuarios.enviarToken');
    Route::post('/verificar/{token}', [UsuarioController::class, 'verifyToken'])->name('usuarios.verifyToken');

    Route::get('/logged', [UsuarioController::class, 'logged'])->name('usuarios.logged')
        ->middleware('auth');

    Route::post('/login', [UsuarioController::class, 'login'])->name('usuarios.login');
    Route::post('/logout', [UsuarioController::class, 'logout'])->name('usuarios.logout')
        ->middleware('auth');
});
