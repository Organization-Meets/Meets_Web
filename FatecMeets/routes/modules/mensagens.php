<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MensagenController;

Route::prefix('mensagens')->group(function () {
    Route::get('/', [MensagenController::class, 'index']);      // Listar todos
    Route::get('/{id}', [MensagenController::class, 'show']);   // Mostrar 1
    Route::post('/', [MensagenController::class, 'store']);     // Criar
    Route::put('/{id}', [MensagenController::class, 'update']); // Atualizar
    Route::delete('/{id}', [MensagenController::class, 'destroy']); // Deletar
});
