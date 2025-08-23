<?php
use App\Http\Controllers\EventoController;

Route::middleware('auth')->group(function () {
    Route::get('/eventos/create', [EventoController::class, 'create'])->name('eventos.create');
    Route::post('/eventos', [EventoController::class, 'store'])->name('eventos.store');
    Route::get('/eventos/{id_evento}/edit', [EventoController::class, 'edit'])->name('eventos.edit');
    Route::put('/eventos/{id_evento}', [EventoController::class, 'update'])->name('eventos.update');
    Route::delete('/eventos/{id_evento}', [EventoController::class, 'destroy'])->name('eventos.destroy');
});

// rota json para perfil
Route::get('/perfil/eventos', [EventoController::class, 'eventosUsuario']);
Route::get('/perfil/eventos/salvos', [EventoController::class, 'eventosSalvosUsuario']);

?>