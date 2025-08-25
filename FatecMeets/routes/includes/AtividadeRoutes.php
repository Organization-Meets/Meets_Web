<?php
use App\Http\Controllers\AtividadeController;

Route::prefix('atividades')->name('atividades.')->group(function () {
    Route::get('/', [AtividadeController::class, 'index'])->name('index'); // Listar todas as atividades
    Route::get('/{id_atividade}', [AtividadeController::class, 'show'])
        ->where('id_atividade', '[0-9]+')
        ->name('show'); // Mostrar detalhes

    Route::post('/', [AtividadeController::class, 'store'])->name('store'); // Criar nova atividade

    Route::put('/{id_atividade}', [AtividadeController::class, 'update'])
        ->where('id_atividade', '[0-9]+')
        ->name('update'); // Atualizar

    Route::delete('/{id_atividade}', [AtividadeController::class, 'destroy'])
        ->where('id_atividade', '[0-9]+')
        ->name('destroy'); // Deletar
});
