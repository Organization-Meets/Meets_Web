<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdicionaiController;

Route::prefix('adicionais')->group(function () {
    Route::get('/', [AdicionaiController::class, 'index']);      // Listar todos
    Route::get('/{id}', [AdicionaiController::class, 'show']);   // Mostrar 1
    Route::post('/', [AdicionaiController::class, 'store']);     // Criar
    Route::put('/{id}', [AdicionaiController::class, 'update']); // Atualizar
    Route::delete('/{id}', [AdicionaiController::class, 'destroy']); // Deletar
});
