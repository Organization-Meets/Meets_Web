<?php
use App\Http\Controllers\AlunoController;
Route::post('/aluno/{id_usuario}', [AlunoController::class, 'store'])->name('aluno.store');
?>