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
