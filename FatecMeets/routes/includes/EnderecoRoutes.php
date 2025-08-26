<?php

use App\Http\Controllers\EnderecoController;

// Rotas CRUD para Endereços
Route::get('/enderecos', [EnderecoController::class, 'index'])->name('enderecos.index');

Route::get('/enderecos/create', [EnderecoController::class, 'create'])->name('enderecos.create');
Route::post('/enderecos', [EnderecoController::class, 'store'])->name('enderecos.store');

Route::get('/enderecos/{id_endereco}', [EnderecoController::class, 'show'])
    ->where('id_endereco', '[0-9]+')
    ->name('enderecos.show');

Route::get('/enderecos/{id_endereco}/edit', [EnderecoController::class, 'edit'])
    ->where('id_endereco', '[0-9]+')
    ->name('enderecos.edit');

Route::put('/enderecos/{id_endereco}', [EnderecoController::class, 'update'])
    ->where('id_endereco', '[0-9]+')
    ->name('enderecos.update');

Route::delete('/enderecos/{id_endereco}', [EnderecoController::class, 'destroy'])
    ->where('id_endereco', '[0-9]+')
    ->name('enderecos.destroy');

// Rotas específicas (exemplo): buscar endereços de um usuário
Route::get('/usuarios/{id_usuario}/enderecos', [EnderecoController::class, 'getByUsuarioId'])
    ->where('id_usuario', '[0-9]+')
    ->name('enderecos.getByUsuario');

