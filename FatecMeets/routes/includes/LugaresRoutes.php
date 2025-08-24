<?php
use App\Http\Controllers\LugaresController;

// Rotas API
Route::prefix('api')->group(function () {
    Route::get('/lugares', [LugaresController::class, 'getAllJson']);
});

// Rotas web normais
Route::get('/lugares/{id_lugar}', [LugaresController::class, 'show']);
Route::get('/lugares', [LugaresController::class, 'index']); 
Route::post('/lugares', [LugaresController::class, 'store']);
Route::put('/lugares/{id_lugar}', [LugaresController::class, 'update']);
Route::delete('/lugares/{id_lugar}', [LugaresController::class, 'destroy']);
