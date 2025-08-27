<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventoController;

Route::prefix('eventos')->group(function () {
    Route::get('/', [EventoController::class, 'index']);      // Listar todos
    Route::get('/{id}', [EventoController::class, 'show']);   // Mostrar 1
    Route::post('/', [EventoController::class, 'store']);     // Criar
    Route::put('/{id}', [EventoController::class, 'update']); // Atualizar
    Route::delete('/{id}', [EventoController::class, 'destroy']); // Deletar
});
