<?php
use App\Http\Controllers\GameficacaoController;

Route::prefix('gameficacoes')->name('gameficacoes.')->group(function () {

    Route::post('/store/{id_usuario}', [GameficacaoController::class, 'store'])
        ->where('id_usuario', '[0-9]+')
        ->name('store');

    Route::get('/', [GameficacaoController::class, 'index'])->name('index');
    Route::get('/create', [GameficacaoController::class, 'create'])->name('create');

    Route::get('/{id_gameficacao}', [GameficacaoController::class, 'show'])
        ->where('id_gameficacao', '[0-9]+')
        ->name('show');

    Route::get('/{id_gameficacao}/edit', [GameficacaoController::class, 'edit'])
        ->where('id_gameficacao', '[0-9]+')
        ->name('edit');

    Route::put('/{id_gameficacao}', [GameficacaoController::class, 'update'])
        ->where('id_gameficacao', '[0-9]+')
        ->name('update');

    Route::delete('/{id_gameficacao}', [GameficacaoController::class, 'destroy'])
        ->where('id_gameficacao', '[0-9]+')
        ->name('destroy');
});
