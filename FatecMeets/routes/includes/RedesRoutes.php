<?php

use App\Http\Controllers\RedesController;

// Rotas CRUD para Redes
Route::get('/redes', [RedesController::class, 'index'])->name('redes.index');

Route::get('/redes/create', [RedesController::class, 'create'])->name('redes.create');
Route::post('/redes', [RedesController::class, 'store'])->name('redes.store');

Route::get('/redes/{id_redes}', [RedesController::class, 'show'])
    ->where('id_redes', '[0-9]+')
    ->name('redes.show');

Route::get('/redes/{id_redes}/edit', [RedesController::class, 'edit'])
    ->where('id_redes', '[0-9]+')
    ->name('redes.edit');

Route::put('/redes/{id_redes}', [RedesController::class, 'update'])
    ->where('id_redes', '[0-9]+')
    ->name('redes.update');

Route::delete('/redes/{id_redes}', [RedesController::class, 'destroy'])
    ->where('id_redes', '[0-9]+')
    ->name('redes.destroy');

// Rota específica: buscar redes vinculadas a adicionais
Route::get('/adicionais/{id_adicionais}/redes', [RedesController::class, 'getByAdicionaisId'])
    ->where('id_adicionais', '[0-9]+')
    ->name('redes.getByAdicionais');
