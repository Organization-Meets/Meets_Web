<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AtividadeController;

Route::prefix('atividades')->group(function () {
    Route::get('/', [AtividadeController::class, 'index']);      // Listar todos
    Route::get('/{id}', [AtividadeController::class, 'show']);   // Mostrar 1
    Route::post('/', [AtividadeController::class, 'store']);     // Criar
    Route::put('/{id}', [AtividadeController::class, 'update']); // Atualizar
    Route::delete('/{id}', [AtividadeController::class, 'destroy']); // Deletar
});
