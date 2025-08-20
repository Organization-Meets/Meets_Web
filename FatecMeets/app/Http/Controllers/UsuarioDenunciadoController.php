<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario_denunciado;

class UsuarioDenunciadoController extends Controller
{
    public function create(){
        return view('usuario_denunciado.create');
    }

    public function store(Request $request){
        $usuarioDenunciado = new Usuario_denunciado();
        $usuarioDenunciado->id_usuario = $request->input('id_usuario');
        $usuarioDenunciado->id_administrador = $request->input('id_administrador');
        $usuarioDenunciado->id_lixo = $request->input('id_lixo');
        $usuarioDenunciado->motivo_denuncia = $request->input('motivo_denuncia');
        $usuarioDenunciado->status_denuncia = $request->input('status_denuncia', 'pendente');
        $usuarioDenunciado->save();
    }

    public function edit($id_usuario_denunciado){
        $usuarioDenunciado = Usuario_denunciado::find($id_usuario_denunciado);
        return view('usuario_denunciado.edit', compact('usuarioDenunciado'));
    }

    public function update(Request $request, $id_usuario_denunciado){
        $usuarioDenunciado = Usuario_denunciado::find($id_usuario_denunciado);
        $usuarioDenunciado->id_usuario = $request->input('id_usuario');
        $usuarioDenunciado->id_administrador = $request->input('id_administrador');
        $usuarioDenunciado->id_lixo = $request->input('id_lixo');
        $usuarioDenunciado->motivo_denuncia = $request->input('motivo_denuncia');
        $usuarioDenunciado->status_denuncia = $request->input('status_denuncia', $usuarioDenunciado->status_denuncia);
        $usuarioDenunciado->save();
        return true;
    }

    public function destroy($id_usuario_denunciado){
        $usuarioDenunciado = Usuario_denunciado::find($id_usuario_denunciado);
        $usuarioDenunciado->delete();
        return true;
    }

    public function show($id_usuario_denunciado){
        $usuarioDenunciado = Usuario_denunciado::find($id_usuario_denunciado);
        return view('usuario_denunciado.show', compact('usuarioDenunciado'));
    }

    public function index(){
        $usuariosDenunciados = Usuario_denunciado::all();
        return view('usuario_denunciado.index', compact('usuariosDenunciados'));
    }

    public function getByUsuarioId($id_usuario){
        return Usuario_denunciado::where('id_usuario', $id_usuario)->get();
    }
}
