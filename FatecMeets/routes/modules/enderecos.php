<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EnderecoController;

Route::prefix('enderecos')->group(function () {
    Route::get('/', [EnderecoController::class, 'index']);      // Listar todos
    Route::get('/{id}', [EnderecoController::class, 'show']);   // Mostrar 1
    Route::post('/', [EnderecoController::class, 'store']);     // Criar
    Route::put('/{id}', [EnderecoController::class, 'update']); // Atualizar
    Route::delete('/{id}', [EnderecoController::class, 'destroy']); // Deletar
});
