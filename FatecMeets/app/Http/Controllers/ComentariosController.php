<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comentarios;

// Controlador responsável por gerenciar comentários
class ComentariosController extends Controller
{
    public function create(){
        return view('comentarios.create');
    }

    public function store(Request $request){
        $comentario = new Comentarios();
        $comentario->descricao_comentario = $request->input('descricao_comentario');
        $comentario->id_usuario = $request->input('id_usuario');
        $comentario->id_atividade = $request->input('id_atividade');
        $comentario->save();
    }

    public function edit($id_comentario){
        $comentario = Comentarios::find($id_comentario);
        return view('comentarios.edit', compact('comentario'));
    }

    public function update(Request $request, $id_comentario){
        $comentario = Comentarios::find($id_comentario);
        $comentario->descricao_comentario = $request->input('descricao_comentario');
        $comentario->id_usuario = $request->input('id_usuario');
        $comentario->id_atividade = $request->input('id_atividade');
        $comentario->save();
        return true;
    }

    public function destroy($id_comentario){
        $comentario = Comentarios::find($id_comentario);
        $comentario->delete();
        return true;
    }

    public function show($id_comentario){
        $comentario = Comentarios::find($id_comentario);
        return view('comentarios.show', compact('comentario'));
    }

    public function index(){
        $comentarios = Comentarios::all();
        return view('comentarios.index', compact('comentarios'));
    }

    public function getByUsuarioId($id_usuario){
        return Comentarios::where('id_usuario', $id_usuario)->get();
    }
}
