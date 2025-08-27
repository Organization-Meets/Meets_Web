<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConexoeController;

Route::prefix('conexoes')->group(function () {
    Route::get('/', [ConexoeController::class, 'index']);      // Listar todos
    Route::get('/{id}', [ConexoeController::class, 'show']);   // Mostrar 1
    Route::post('/', [ConexoeController::class, 'store']);     // Criar
    Route::put('/{id}', [ConexoeController::class, 'update']); // Atualizar
    Route::delete('/{id}', [ConexoeController::class, 'destroy']); // Deletar
});
