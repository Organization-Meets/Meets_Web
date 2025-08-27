<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ComplementoController;

Route::prefix('complementos')->group(function () {
    Route::get('/', [ComplementoController::class, 'index']);      // Listar todos
    Route::get('/{id}', [ComplementoController::class, 'show']);   // Mostrar 1
    Route::post('/', [ComplementoController::class, 'store']);     // Criar
    Route::put('/{id}', [ComplementoController::class, 'update']); // Atualizar
    Route::delete('/{id}', [ComplementoController::class, 'destroy']); // Deletar
});
