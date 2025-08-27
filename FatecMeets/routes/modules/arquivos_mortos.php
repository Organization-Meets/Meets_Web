<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Arquivos_mortoController;

Route::prefix('arquivos_mortos')->group(function () {
    Route::get('/', [Arquivos_mortoController::class, 'index']);      // Listar todos
    Route::get('/{id}', [Arquivos_mortoController::class, 'show']);   // Mostrar 1
    Route::post('/', [Arquivos_mortoController::class, 'store']);     // Criar
    Route::put('/{id}', [Arquivos_mortoController::class, 'update']); // Atualizar
    Route::delete('/{id}', [Arquivos_mortoController::class, 'destroy']); // Deletar
});
