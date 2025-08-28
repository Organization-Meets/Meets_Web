<?php 

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('componentes.welcome');
})->name('home');

Route::redirect('/inicio', '/')->name('inicio');
Route::get('/login', function () {
    return view('componentes.login');
})->name('login');
