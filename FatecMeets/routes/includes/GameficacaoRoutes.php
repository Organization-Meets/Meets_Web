<?php
use App\Http\Controllers\GameficacaoController;

// Listar todas as gameficações
Route::get('/gameficacoes', [GameficacaoController::class, 'index']);

// Mostrar detalhes de uma gameficação
Route::get('/gameficacoes/{id_gameficacao}', [GameficacaoController::class, 'show']);

// Criar nova gameficação (formulário)
Route::get('/gameficacoes/create', [GameficacaoController::class, 'create']);

// Armazenar nova gameficação
Route::post('/gameficacoes', [GameficacaoController::class, 'store']);

// Editar gameficação (formulário)
Route::get('/gameficacoes/{id_gameficacao}/edit', [GameficacaoController::class, 'edit']);

// Atualizar gameficação
Route::put('/gameficacoes/{id_gameficacao}', [GameficacaoController::class, 'update']);

// Excluir gameficação
Route::delete('/gameficacoes/{id_gameficacao}', [GameficacaoController::class, 'destroy']);

// Buscar gameficações pelo ID do usuário (ou do logado, se não passar)
Route::get('/gameficacoes/usuario/{id_usuario?}', [GameficacaoController::class, 'getByUsuarioId']);
