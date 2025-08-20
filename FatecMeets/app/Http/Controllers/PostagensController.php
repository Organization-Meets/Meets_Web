<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Postagens;

// Controlador responsável por gerenciar postagens
class PostagensController extends Controller
{
    public function create(){
        return view('postagens.create');
    }

    public function store(Request $request){
        $postagem = new Postagens();
        $postagem->titulo_postagem = $request->input('titulo_postagem');
        $postagem->descricao_postagem = $request->input('descricao_postagem');
        $postagem->imagem_postagem = $request->input('imagem_postagem');
        $postagem->data_postagem = $request->input('data_postagem');
        $postagem->id_usuario = $request->input('id_usuario');
        $postagem->id_atividade = $request->input('id_atividade');
        $postagem->save();
    }

    public function edit($id_postagem){
        $postagem = Postagens::find($id_postagem);
        return view('postagens.edit', compact('postagem'));
    }

    public function update(Request $request, $id_postagem){
        $postagem = Postagens::find($id_postagem);
        $postagem->titulo_postagem = $request->input('titulo_postagem');
        $postagem->descricao_postagem = $request->input('descricao_postagem');
        $postagem->imagem_postagem = $request->input('imagem_postagem');
        $postagem->data_postagem = $request->input('data_postagem', $postagem->data_postagem);
        $postagem->id_usuario = $request->input('id_usuario');
        $postagem->id_atividade = $request->input('id_atividade');
        $postagem->save();
        return true;
    }

    public function destroy($id_postagem){
        $postagem = Postagens::find($id_postagem);
        $postagem->delete();
        return true;
    }

    public function show($id_postagem){
        $postagem = Postagens::find($id_postagem);
        return view('postagens.show', compact('postagem'));
    }

    public function index(){
        $postagens = Postagens::all();
        return view('postagens.index', compact('postagens'));
    }

    public function getByUsuarioId($id_usuario){
        return Postagens::where('id_usuario', $id_usuario)->get();
    }
}
