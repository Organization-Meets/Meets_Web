<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AcademicoController;

Route::prefix('academicos')->group(function () {
    Route::get('/', [AcademicoController::class, 'index']);      // Listar todos
    Route::get('/{id}', [AcademicoController::class, 'show']);   // Mostrar 1
    Route::post('/', [AcademicoController::class, 'store']);     // Criar
    Route::put('/{id}', [AcademicoController::class, 'update']); // Atualizar
    Route::delete('/{id}', [AcademicoController::class, 'destroy']); // Deletar
});
