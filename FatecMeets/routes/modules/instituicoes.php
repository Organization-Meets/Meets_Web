<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InstituicoeController;

Route::prefix('instituicoes')->group(function () {
    Route::get('/', [InstituicoeController::class, 'index']);      // Listar todos
    Route::get('/{id}', [InstituicoeController::class, 'show']);   // Mostrar 1
    Route::post('/', [InstituicoeController::class, 'store']);     // Criar
    Route::put('/{id}', [InstituicoeController::class, 'update']); // Atualizar
    Route::delete('/{id}', [InstituicoeController::class, 'destroy']); // Deletar
});
