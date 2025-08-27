<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RedeController;

Route::prefix('redes')->group(function () {
    Route::get('/', [RedeController::class, 'index']);      // Listar todos
    Route::get('/{id}', [RedeController::class, 'show']);   // Mostrar 1
    Route::post('/', [RedeController::class, 'store']);     // Criar
    Route::put('/{id}', [RedeController::class, 'update']); // Atualizar
    Route::delete('/{id}', [RedeController::class, 'destroy']); // Deletar
});
