<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LugareController;

Route::prefix('lugares')->group(function () {
    Route::get('/', [LugareController::class, 'index']);      // Listar todos
    Route::get('/{id}', [LugareController::class, 'show']);   // Mostrar 1
    Route::post('/', [LugareController::class, 'store']);     // Criar
    Route::put('/{id}', [LugareController::class, 'update']); // Atualizar
    Route::delete('/{id}', [LugareController::class, 'destroy']); // Deletar
});
