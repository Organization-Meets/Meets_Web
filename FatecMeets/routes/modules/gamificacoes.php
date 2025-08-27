<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GamificacoeController;

Route::prefix('gamificacoes')->group(function () {
    Route::get('/', [GamificacoeController::class, 'index']);      // Listar todos
    Route::get('/{id}', [GamificacoeController::class, 'show']);   // Mostrar 1
    Route::post('/', [GamificacoeController::class, 'store']);     // Criar
    Route::put('/{id}', [GamificacoeController::class, 'update']); // Atualizar
    Route::delete('/{id}', [GamificacoeController::class, 'destroy']); // Deletar
});
