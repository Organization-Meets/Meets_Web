<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comentarios_denunciado;

class ComentariosDenunciadoController extends Controller
{
    public function create(){
        return view('comentarios_denunciado.create');
    }

    public function store(Request $request){
        $comentarioDenunciado = new Comentarios_denunciado();
        $comentarioDenunciado->id_comentario = $request->input('id_comentario');
        $comentarioDenunciado->id_administrador = $request->input('id_administrador');
        $comentarioDenunciado->id_lixo = $request->input('id_lixo');
        $comentarioDenunciado->motivo_denuncia = $request->input('motivo_denuncia');
        $comentarioDenunciado->status_denuncia = $request->input('status_denuncia', 'pendente');
        $comentarioDenunciado->save();
    }

    public function edit($id_comentarios_denunciado){
        $comentarioDenunciado = Comentarios_denunciado::find($id_comentarios_denunciado);
        return view('comentarios_denunciado.edit', compact('comentarioDenunciado'));
    }

    public function update(Request $request, $id_comentarios_denunciado){
        $comentarioDenunciado = Comentarios_denunciado::find($id_comentarios_denunciado);
        $comentarioDenunciado->id_comentario = $request->input('id_comentario');
        $comentarioDenunciado->id_administrador = $request->input('id_administrador');
        $comentarioDenunciado->id_lixo = $request->input('id_lixo');
        $comentarioDenunciado->motivo_denuncia = $request->input('motivo_denuncia');
        $comentarioDenunciado->status_denuncia = $request->input('status_denuncia', $comentarioDenunciado->status_denuncia);
        $comentarioDenunciado->save();
        return true;
    }

    public function destroy($id_comentarios_denunciado){
        $comentarioDenunciado = Comentarios_denunciado::find($id_comentarios_denunciado);
        $comentarioDenunciado->delete();
        return true;
    }

    public function show($id_comentarios_denunciado){
        $comentarioDenunciado = Comentarios_denunciado::find($id_comentarios_denunciado);
        return view('comentarios_denunciado.show', compact('comentarioDenunciado'));
    }

    public function index(){
        $comentariosDenunciados = Comentarios_denunciado::all();
        return view('comentarios_denunciado.index', compact('comentariosDenunciados'));
    }

    public function getByComentarioId($id_comentario){
        return Comentarios_denunciado::where('id_comentario', $id_comentario)->get();
    }
}
