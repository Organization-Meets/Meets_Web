<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\EventoController;

// -----------------------------------------------------------------------------
// Rotas de API
// -----------------------------------------------------------------------------

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// ---------------------- USUÁRIOS ----------------------
Route::get('/usuarios', [UsuarioController::class, 'index']);
Route::get('/usuarios/{id}', [UsuarioController::class, 'show']);
Route::post('/usuarios', [UsuarioController::class, 'store']);
Route::put('/usuarios/{id}', [UsuarioController::class, 'update']);
Route::delete('/usuarios/{id}', [UsuarioController::class, 'destroy']);
Route::get('/usuarios/logged', [UsuarioController::class, 'logged']);

// ---------------------- EVENTOS ----------------------
Route::get('/eventos', [EventoController::class, 'index']);
Route::get('/eventos/{id}', [EventoController::class, 'show']);
Route::post('/eventos', [EventoController::class, 'store']);
Route::put('/eventos/{id}', [EventoController::class, 'update']);
Route::delete('/eventos/{id}', [EventoController::class, 'destroy']);
