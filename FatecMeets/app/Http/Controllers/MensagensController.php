<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mensagens;

class MensagensController extends Controller
{
    public function create(){
        return view('mensagens.create');
    }

    public function store(Request $request){
        $mensagem = new Mensagens();
        $mensagem->id_chat = $request->input('id_chat');
        $mensagem->id_gameficacao = $request->input('id_gameficacao');
        $mensagem->descricao_mensagens = $request->input('descricao_mensagens');
        $mensagem->data_mensagem = $request->input('data_mensagem');
        $mensagem->save();
    }

    public function edit($id_mensagens){
        $mensagem = Mensagens::find($id_mensagens);
        return view('mensagens.edit', compact('mensagem'));
    }

    public function update(Request $request, $id_mensagens){
        $mensagem = Mensagens::find($id_mensagens);
        $mensagem->id_chat = $request->input('id_chat');
        $mensagem->id_gameficacao = $request->input('id_gameficacao');
        $mensagem->descricao_mensagens = $request->input('descricao_mensagens');
        $mensagem->data_mensagem = $request->input('data_mensagem', $mensagem->data_mensagem);
        $mensagem->save();
        return true;
    }

    public function destroy($id_mensagens){
        $mensagem = Mensagens::find($id_mensagens);
        $mensagem->delete();
        return true;
    }

    public function show($id_mensagens){
        $mensagem = Mensagens::find($id_mensagens);
        return view('mensagens.show', compact('mensagem'));
    }

    public function index(){
        $mensagens = Mensagens::all();
        return view('mensagens.index', compact('mensagens'));
    }

    public function getByChatId($id_chat){
        return Mensagens::where('id_chat', $id_chat)->get();
    }

    public function getByGameficacaoId($id_gameficacao){
        return Mensagens::where('id_gameficacao', $id_gameficacao)->get();
    }
}
