<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TelefoneController;

Route::prefix('telefones')->group(function () {
    Route::get('/', [TelefoneController::class, 'index']);      // Listar todos
    Route::get('/{id}', [TelefoneController::class, 'show']);   // Mostrar 1
    Route::post('/', [TelefoneController::class, 'store']);     // Criar
    Route::put('/{id}', [TelefoneController::class, 'update']); // Atualizar
    Route::delete('/{id}', [TelefoneController::class, 'destroy']); // Deletar
});
