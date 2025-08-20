<?php
use App\Http\Controllers\UsuarioController;
Route::get('/', [UsuarioController::class, 'home'])->name('usuario.home');
Route::get('/usuario/logged', function() {
    $usuario = Auth::user();
    return response()->json([
        'logado' => $usuario ? true : false,
        'nome' => $usuario ? $usuario->email : null,
        'id' => $usuario ? $usuario->id_usuario : null
    ]);
});
Route::get('/usuarios/create', [UsuarioController::class, 'create'])->name('usuarios.create');
Route::post('/usuarios', [UsuarioController::class, 'store'])->name('usuario.store');
Route::get('/usuarios/{id_usuario}', [UsuarioController::class, 'show'])
    ->where('id_usuario', '[0-9]+')
    ->name('usuarios.show');
Route::get('/usuarios/{id_usuario}/edit', [UsuarioController::class, 'edit'])->where('id_usuario', '[0-9]+')->name('usuarios.edit');
Route::put('/usuarios/{id_usuario}', [UsuarioController::class, 'update'])->where('id_usuario', '[0-9]+')->name('usuarios.update');
Route::delete('/usuarios/{id_usuario}', [UsuarioController::class, 'destroy'])->where('id_usuario', '[0-9]+')->name('usuarios.destroy');
Route::get('/usuarios/perfil', [UsuarioController::class, 'perfil'])->name('usuario.perfil');
Route::get('/usuarios/logout', [UsuarioController::class, 'logout'])->name('usuarios.logout');
Route::get('/usuarios/loginForm', [UsuarioController::class, 'loginForm'])->name('usuario.loginForm');
Route::post('/usuarios/login', [UsuarioController::class, 'login'])->name('usuario.login');
?>