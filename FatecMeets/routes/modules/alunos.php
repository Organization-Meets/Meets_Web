<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlunoController;

Route::prefix('alunos')->group(function () {
    Route::get('/', [AlunoController::class, 'index']);      // Listar todos
    Route::get('/{id}', [AlunoController::class, 'show']);   // Mostrar 1
    Route::post('/', [AlunoController::class, 'store']);     // Criar
    Route::put('/{id}', [AlunoController::class, 'update']); // Atualizar
    Route::delete('/{id}', [AlunoController::class, 'destroy']); // Deletar
});
