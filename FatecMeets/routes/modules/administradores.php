<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdministradoreController;

Route::prefix('administradores')->group(function () {
    Route::get('/', [AdministradoreController::class, 'index']);      // Listar todos
    Route::get('/{id}', [AdministradoreController::class, 'show']);   // Mostrar 1
    Route::post('/', [AdministradoreController::class, 'store']);     // Criar
    Route::put('/{id}', [AdministradoreController::class, 'update']); // Atualizar
    Route::delete('/{id}', [AdministradoreController::class, 'destroy']); // Deletar
});
