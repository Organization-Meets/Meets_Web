<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MembroController;

Route::prefix('membros')->group(function () {
    Route::get('/', [MembroController::class, 'index']);      // Listar todos
    Route::get('/{id}', [MembroController::class, 'show']);   // Mostrar 1
    Route::post('/', [MembroController::class, 'store']);     // Criar
    Route::put('/{id}', [MembroController::class, 'update']); // Atualizar
    Route::delete('/{id}', [MembroController::class, 'destroy']); // Deletar
});
