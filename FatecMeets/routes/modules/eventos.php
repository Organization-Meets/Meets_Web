<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventoController;

Route::prefix('eventos')->group(function () {
    Route::get('/', [EventoController::class, 'index'])->name('eventos.index');      // Listar todos
    Route::get('/{id}', [EventoController::class, 'show'])->name('eventos.show');    // Mostrar 1
    Route::post('/', [EventoController::class, 'store'])->name('eventos.store');     // Criar
    Route::put('/{id}', [EventoController::class, 'update'])->name('eventos.update');// Atualizar
    Route::delete('/{id}', [EventoController::class, 'destroy'])->name('eventos.destroy'); // Deletar
});
