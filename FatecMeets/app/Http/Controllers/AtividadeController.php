<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Atividade;

class AtividadeController extends Controller
{
    public function create(){
        return view('atividade.create');
    }

    public function store(Request $request){
        $atividade = new Atividade();
        $atividade->likes = $request->input('likes', 0);
        $atividade->score = $request->input('score', 0);
        $atividade->tipo_atividade = $request->input('tipo_atividade');
        $atividade->id_gamificacao = $request->input('id_gamificacao');
        $atividade->save();
    }

    public function edit($id_atividade){
        $atividade = Atividade::find($id_atividade);
        return view('atividade.edit', compact('atividade'));
    }

    public function update(Request $request, $id_atividade){
        $atividade = Atividade::find($id_atividade);
        $atividade->likes = $request->input('likes', $atividade->likes);
        $atividade->score = $request->input('score', $atividade->score);
        $atividade->tipo_atividade = $request->input('tipo_atividade', $atividade->tipo_atividade);
        $atividade->id_gamificacao = $request->input('id_gamificacao', $atividade->id_gamificacao);
        $atividade->save();
        return true;
    }

    public function destroy($id_atividade){
        $atividade = Atividade::find($id_atividade);
        $atividade->delete();
        return true;
    }

    public function show($id_atividade){
        $atividade = Atividade::find($id_atividade);
        return view('atividade.show', compact('atividade'));
    }

    public function index(){
        $atividades = Atividade::all();
        return view('atividade.index', compact('atividades'));
    }

    public function getByGamificacaoId($id_gamificacao){
        return Atividade::where('id_gamificacao', $id_gamificacao)->get();
    }
}
