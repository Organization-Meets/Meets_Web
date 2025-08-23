<?php
use App\Http\Controllers\LugaresController;

Route::get('/lugares', [LugaresController::class, 'index']); // retorna todos os lugares
Route::get('/lugares/{id_lugar}', [LugaresController::class, 'show']);
Route::post('/lugares', [LugaresController::class, 'store']);
Route::put('/lugares/{id_lugar}', [LugaresController::class, 'update']);
Route::delete('/lugares/{id_lugar}', [LugaresController::class, 'destroy']);
Route::get('/lugares/json', [LugaresController::class, 'getAllJson']);
