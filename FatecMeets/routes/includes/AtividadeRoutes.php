<?php
use App\Http\Controllers\AtividadeController;

Route::middleware('auth')->group(function () {
    Route::get('/atividades', [AtividadeController::class, 'index']);           // Listar todas as atividades
    Route::get('/atividades/{id_atividade}', [AtividadeController::class, 'show']); // Mostrar detalhes
    Route::post('/atividades', [AtividadeController::class, 'store']);          // Criar nova atividade
    Route::put('/atividades/{id_atividade}', [AtividadeController::class, 'update']); // Atualizar
    Route::delete('/atividades/{id_atividade}', [AtividadeController::class, 'destroy']); // Deletar
});