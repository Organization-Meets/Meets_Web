<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Academicos;
use App\Models\Usuarios;
use App\Http\Controllers\UsuariosController;

class AcademicosController extends Controller
{
    public function create(){
        return view('academicos.create');
    }

    public function store(Request $request, $usuario_id){
        $academicos = new Academicos();
        $academicos->id_usuario = $usuario_id;
        $academicos->nome_academicos = $request->input('nome_academicos');
        $academicos->ra_academicos = $request->input('ra_academicos');
        $academicos->save();

        $usuariosController = new UsuariosController();
        $perfil = $usuariosController->perfil();
        return $perfil;
    }
}
