<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DenunciaController;

Route::prefix('denuncias')->group(function () {
    Route::get('/', [DenunciaController::class, 'index']);      // Listar todos
    Route::get('/{id}', [DenunciaController::class, 'show']);   // Mostrar 1
    Route::post('/', [DenunciaController::class, 'store']);     // Criar
    Route::put('/{id}', [DenunciaController::class, 'update']); // Atualizar
    Route::delete('/{id}', [DenunciaController::class, 'destroy']); // Deletar
});
