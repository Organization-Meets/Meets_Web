<?php

use App\Http\Controllers\InstituicaoController;

// Rotas CRUD para Instituições
Route::get('/instituicoes', [InstituicaoController::class, 'index'])->name('instituicoes.index');

Route::get('/instituicoes/create', [InstituicaoController::class, 'create'])->name('instituicoes.create');
Route::post('/instituicoes', [InstituicaoController::class, 'store'])->name('instituicoes.store');

Route::get('/instituicoes/{id_instituicao}', [InstituicaoController::class, 'show'])
    ->where('id_instituicao', '[0-9]+')
    ->name('instituicoes.show');

Route::get('/instituicoes/{id_instituicao}/edit', [InstituicaoController::class, 'edit'])
    ->where('id_instituicao', '[0-9]+')
    ->name('instituicoes.edit');

Route::put('/instituicoes/{id_instituicao}', [InstituicaoController::class, 'update'])
    ->where('id_instituicao', '[0-9]+')
    ->name('instituicoes.update');

Route::delete('/instituicoes/{id_instituicao}', [InstituicaoController::class, 'destroy'])
    ->where('id_instituicao', '[0-9]+')
    ->name('instituicoes.destroy');

// Rotas específicas (exemplo): buscar instituições de um usuário
Route::get('/usuarios/{id_usuario}/instituicoes', [InstituicaoController::class, 'getByUsuarioId'])
    ->where('id_usuario', '[0-9]+')
    ->name('instituicoes.getByUsuario');

