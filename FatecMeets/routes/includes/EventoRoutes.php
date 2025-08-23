<?php
use App\Http\Controllers\EventoController;

Route::middleware('auth')->group(function () {
    Route::get('/eventos/create', [EventoController::class, 'create'])->name('eventos.create');
    Route::get('/eventos', [EventoController::class, 'index']);
    Route::get('/eventos/{id_evento}', [EventoController::class, 'show']);
    Route::post('/eventos', [EventoController::class, 'store']);
    Route::put('/eventos/{id_evento}', [EventoController::class, 'update']);
    Route::delete('/eventos/{id_evento}', [EventoController::class, 'destroy']);
});


// rota json para perfil
Route::get('/perfil/eventos', [EventoController::class, 'eventosUsuario']);
Route::get('/perfil/eventos/salvos', [EventoController::class, 'eventosSalvosUsuario']);

// routes/web.php ou routes/api.php


?>