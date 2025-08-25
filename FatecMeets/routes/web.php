<?php 

use Illuminate\Support\Facades\Route;

// Inclui automaticamente todos os arquivos PHP dentro de includes/
foreach (glob(__DIR__ . '/includes/*.php') as $filename) {
    require_once $filename;
}

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::redirect('/inicio', '/')->name('inicio');

// ou em routes/includes/GameficacaoRoutes.php
Route::get('/gameficacao/usuario/{id_usuario}', [App\Http\Controllers\GameficacaoController::class, 'getByUsuarioId']);
Route::post('/usuarios/confirmar-senha', [App\Http\Controllers\UsuarioController::class, 'confirmarSenha']);
