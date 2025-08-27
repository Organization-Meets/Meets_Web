<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ComentarioController;

Route::prefix('comentarios')->group(function () {
    Route::get('/', [ComentarioController::class, 'index']);      // Listar todos
    Route::get('/{id}', [ComentarioController::class, 'show']);   // Mostrar 1
    Route::post('/', [ComentarioController::class, 'store']);     // Criar
    Route::put('/{id}', [ComentarioController::class, 'update']); // Atualizar
    Route::delete('/{id}', [ComentarioController::class, 'destroy']); // Deletar
});
