<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;

Route::prefix('usuarios')->group(function () {
    Route::get('/', [UsuarioController::class, 'index']);          
    Route::get('/{id}', [UsuarioController::class, 'show']);       
    Route::post('/', [UsuarioController::class, 'store']);         
    Route::put('/{id}', [UsuarioController::class, 'update']);     
    Route::delete('/{id}', [UsuarioController::class, 'destroy']); 

    Route::post('/{id}/enviar-token', [UsuarioController::class, 'enviarToken']);
    Route::post('/verificar/{token}', [UsuarioController::class, 'verifyToken']);
    Route::post('/login', [UsuarioController::class, 'login']);
});
