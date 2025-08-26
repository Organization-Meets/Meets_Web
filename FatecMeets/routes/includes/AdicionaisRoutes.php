<?php

use App\Http\Controllers\AdicionaisController;

// Rotas CRUD para Adicionais
Route::get('/adicionais', [AdicionaisController::class, 'index'])->name('adicionais.index');

Route::get('/adicionais/create', [AdicionaisController::class, 'create'])->name('adicionais.create');
Route::post('/adicionais', [AdicionaisController::class, 'store'])->name('adicionais.store');

Route::get('/adicionais/{id_adicionais}', [AdicionaisController::class, 'show'])
    ->where('id_adicionais', '[0-9]+')
    ->name('adicionais.show');

Route::get('/adicionais/{id_adicionais}/edit', [AdicionaisController::class, 'edit'])
    ->where('id_adicionais', '[0-9]+')
    ->name('adicionais.edit');

Route::put('/adicionais/{id_adicionais}', [AdicionaisController::class, 'update'])
    ->where('id_adicionais', '[0-9]+')
    ->name('adicionais.update');

Route::delete('/adicionais/{id_adicionais}', [AdicionaisController::class, 'destroy'])
    ->where('id_adicionais', '[0-9]+')
    ->name('adicionais.destroy');

// Exemplo de rota extra: obter adicionais de um usuário específico
Route::get('/usuarios/{id_usuario}/adicionais', [AdicionaisController::class, 'getByUsuarioId'])
    ->where('id_usuario', '[0-9]+')
    ->name('adicionais.getByUsuario');

