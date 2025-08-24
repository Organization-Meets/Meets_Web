<?php
use App\Http\Controllers\AlunoController;

Route::prefix('alunos')->name('alunos.')->group(function () {
    // Listar todos os alunos
    Route::get('/', [AlunoController::class, 'index'])->name('index');

    // Formulário de criação
    Route::get('/create', [AlunoController::class, 'create'])->name('create');

    // Armazenar aluno (com ID do usuário)
    Route::post('/{id_usuario}', [AlunoController::class, 'store'])
        ->where('id_usuario', '[0-9]+')
        ->name('store');

    // Mostrar detalhes
    Route::get('/{id_aluno}', [AlunoController::class, 'show'])
        ->where('id_aluno', '[0-9]+')
        ->name('show');

    // Editar aluno
    Route::get('/{id_aluno}/edit', [AlunoController::class, 'edit'])
        ->where('id_aluno', '[0-9]+')
        ->name('edit');

    // Atualizar aluno
    Route::put('/{id_aluno}', [AlunoController::class, 'update'])
        ->where('id_aluno', '[0-9]+')
        ->name('update');

    // Excluir aluno
    Route::delete('/{id_aluno}', [AlunoController::class, 'destroy'])
        ->where('id_aluno', '[0-9]+')
        ->name('destroy');

    // Buscar alunos por usuário (opcional)
    Route::get('/usuario/{id_usuario?}', [AlunoController::class, 'getByUsuarioId'])->name('usuario');
});
