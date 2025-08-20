<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gameficacao;

class GameficacaoController extends Controller
{
    public function create(){
        return view('gameficacao.create');
    }

    public function store(Request $request, $usuario_id){
        $gameficacao = new Gameficacao();
        $gameficacao->score_total = $request->input('score_total', 0);
        $gameficacao->nickname = $request->input('nickname');
        $gameficacao->id_usuario = $usuario_id;
        $gameficacao->save();
    }

    public function edit($id_gameficacao){
        $gameficacao = Gameficacao::find($id_gameficacao);
        return view('gameficacao.edit', compact('gameficacao'));
    }

    public function update(Request $request, $id_gameficacao){
        $gameficacao = Gameficacao::find($id_gameficacao);
        $gameficacao->score_total = $request->input('score_total', $gameficacao->score_total);
        $gameficacao->nickname = $request->input('nickname', $gameficacao->nickname);
        $gameficacao->id_usuario = $request->input('id_usuario', $gameficacao->id_usuario);
        $gameficacao->save();
        return true;
    }

    public function destroy($id_gameficacao){
        $gameficacao = Gameficacao::find($id_gameficacao);
        $gameficacao->delete();
        return true;
    }

    public function show($id_gameficacao){
        $gameficacao = Gameficacao::find($id_gameficacao);
        return view('gameficacao.show', compact('gameficacao'));
    }

    public function index(){
        $gameficacoes = Gameficacao::all();
        return view('gameficacao.index', compact('gameficacoes'));
    }

    public function getByUsuarioId($id_usuario){
        return Gameficacao::where('id_usuario', $id_usuario)->get();
    }
}

