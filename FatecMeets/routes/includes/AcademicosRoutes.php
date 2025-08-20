<?php
use App\Http\Controllers\AcademicosController;
Route::post('/academicos/{id_usuario}', [AcademicosController::class, 'store'])->name('academicos.store');
?>