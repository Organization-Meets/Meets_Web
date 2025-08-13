<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// -----------------------------------------------------------------------------
// Rotas de API
// -----------------------------------------------------------------------------
// Aqui você pode registrar as rotas de API para sua aplicação.
// Essas rotas são carregadas pelo RouteServiceProvider dentro de um grupo
// que recebe o middleware "api". Aproveite para construir sua API!
// -----------------------------------------------------------------------------

// Esta rota retorna os dados do usuário autenticado.
// O middleware 'auth:sanctum' garante que apenas usuários autenticados possam acessar.
// Quando uma requisição GET é feita para '/user', retorna o usuário autenticado.
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

