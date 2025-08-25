<?php
use App\Http\Controllers\EventoController;

Route::prefix('eventos')->name('eventos.')->group(function () {

    Route::post('/store/{id_usuario}', [EventoController::class, 'store'])
        ->where('id_usuario', '[0-9]+')
        ->name('store');

    Route::get('/', [EventoController::class, 'index'])->name('index');
    Route::get('/create', [EventoController::class, 'create'])->name('create');

    Route::get('/{id_evento}', [EventoController::class, 'show'])
        ->where('id_evento', '[0-9]+')
        ->name('show');

    Route::get('/{id_evento}/edit', [EventoController::class, 'edit'])
        ->where('id_evento', '[0-9]+')
        ->name('edit');

    Route::put('/{id_evento}', [EventoController::class, 'update'])
        ->where('id_evento', '[0-9]+')
        ->name('update');

    Route::delete('/{id_evento}', [EventoController::class, 'destroy'])
        ->where('id_evento', '[0-9]+')
        ->name('destroy');

    // JSON: eventos do usuário
    Route::get('/usuario/{id_usuario?}', [EventoController::class, 'eventosUsuario'])
        ->where('id_usuario', '[0-9]+')
        ->name('eventosUsuario');
});
