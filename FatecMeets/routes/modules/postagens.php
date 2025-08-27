<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostagenController;

Route::prefix('postagens')->group(function () {
    Route::get('/', [PostagenController::class, 'index']);      // Listar todos
    Route::get('/{id}', [PostagenController::class, 'show']);   // Mostrar 1
    Route::post('/', [PostagenController::class, 'store']);     // Criar
    Route::put('/{id}', [PostagenController::class, 'update']); // Atualizar
    Route::delete('/{id}', [PostagenController::class, 'destroy']); // Deletar
});
