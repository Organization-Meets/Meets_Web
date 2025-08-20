<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comentario_Postagem;

class ComentarioPostagemController extends Controller
{
    public function create(){
        return view('comentario_postagem.create');
    }

    public function store(Request $request){
        $comentarioPostagem = new Comentario_Postagem();
        $comentarioPostagem->id_postagem = $request->input('id_postagem');
        $comentarioPostagem->id_comentario = $request->input('id_comentario');
        $comentarioPostagem->save();
    }

    public function edit($id_comentario_postagem){
        $comentarioPostagem = Comentario_Postagem::find($id_comentario_postagem);
        return view('comentario_postagem.edit', compact('comentarioPostagem'));
    }

    public function update(Request $request, $id_comentario_postagem){
        $comentarioPostagem = Comentario_Postagem::find($id_comentario_postagem);
        $comentarioPostagem->id_postagem = $request->input('id_postagem');
        $comentarioPostagem->id_comentario = $request->input('id_comentario');
        $comentarioPostagem->save();
        return true;
    }

    public function destroy($id_comentario_postagem){
        $comentarioPostagem = Comentario_Postagem::find($id_comentario_postagem);
        $comentarioPostagem->delete();
        return true;
    }

    public function show($id_comentario_postagem){
        $comentarioPostagem = Comentario_Postagem::find($id_comentario_postagem);
        return view('comentario_postagem.show', compact('comentarioPostagem'));
    }

    public function index(){
        $comentariosPostagem = Comentario_Postagem::all();
        return view('comentario_postagem.index', compact('comentariosPostagem'));
    }

    public function getByPostagemId($id_postagem){
        return Comentario_Postagem::where('id_postagem', $id_postagem)->get();
    }

    public function getByComentarioId($id_comentario){
        return Comentario_Postagem::where('id_comentario', $id_comentario)->get();
    }
}
