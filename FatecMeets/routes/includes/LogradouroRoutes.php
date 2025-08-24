<?php
use App\Http\Controllers\LogradouroController;

Route::get('/logradouros', [LogradouroController::class, 'index']); // retorna todos os logradouros
Route::get('/logradouros/{id_logradouro}', [LogradouroController::class, 'show']);
Route::post('/logradouros', [LogradouroController::class, 'store']);
Route::put('/logradouros/{id_logradouro}', [LogradouroController::class, 'update']);
Route::delete('/logradouros/{id_logradouro}', [LogradouroController::class, 'destroy']);
Route::prefix('api')->group(function () {
    Route::get('/logradouros/{id_endereco}', [LogradouroController::class, 'jsonByEndereco']);
});