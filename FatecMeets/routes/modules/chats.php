<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;

Route::prefix('chats')->group(function () {
    Route::get('/', [ChatController::class, 'index']);      // Listar todos
    Route::get('/{id}', [ChatController::class, 'show']);   // Mostrar 1
    Route::post('/', [ChatController::class, 'store']);     // Criar
    Route::put('/{id}', [ChatController::class, 'update']); // Atualizar
    Route::delete('/{id}', [ChatController::class, 'destroy']); // Deletar
});
