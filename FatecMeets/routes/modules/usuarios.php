<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;

Route::prefix('usuarios')->group(function () {
    Route::get('/', [UsuarioController::class, 'index']);      // Listar todos
    Route::get('/{id}', [UsuarioController::class, 'show']);   // Mostrar 1
    Route::post('/', [UsuarioController::class, 'store']);     // Criar
    Route::put('/{id}', [UsuarioController::class, 'update']); // Atualizar
    Route::delete('/{id}', [UsuarioController::class, 'destroy']); // Deletar
});
