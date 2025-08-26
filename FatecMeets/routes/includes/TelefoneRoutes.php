<?php

use App\Http\Controllers\TelefonesController;

// Rotas CRUD para Telefones
Route::get('/telefones', [TelefonesController::class, 'index'])->name('telefones.index');

Route::get('/telefones/create', [TelefonesController::class, 'create'])->name('telefones.create');
Route::post('/telefones', [TelefonesController::class, 'store'])->name('telefones.store');

Route::get('/telefones/{id_telefone}', [TelefonesController::class, 'show'])
    ->where('id_telefone', '[0-9]+')
    ->name('telefones.show');

Route::get('/telefones/{id_telefone}/edit', [TelefonesController::class, 'edit'])
    ->where('id_telefone', '[0-9]+')
    ->name('telefones.edit');

Route::put('/telefones/{id_telefone}', [TelefonesController::class, 'update'])
    ->where('id_telefone', '[0-9]+')
    ->name('telefones.update');

Route::delete('/telefones/{id_telefone}', [TelefonesController::class, 'destroy'])
    ->where('id_telefone', '[0-9]+')
    ->name('telefones.destroy');

// Rota específica: buscar telefones vinculados a adicionais
Route::get('/adicionais/{id_adicionais}/telefones', [TelefonesController::class, 'getByAdicionaisId'])
    ->where('id_adicionais', '[0-9]+')
    ->name('telefones.getByAdicionais');
