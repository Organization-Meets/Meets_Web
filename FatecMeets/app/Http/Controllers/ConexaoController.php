<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Conexao;

class ConexaoController extends Controller
{
    public function create(){
        return view('conexao.create');
    }

    public function store(Request $request){
        $conexao = new Conexao();
        $conexao->id_gameficacao = $request->input('id_gameficacao');
        $conexao->id_gameficacao_conexao = $request->input('id_gameficacao_conexao');
        $conexao->status_conexao = $request->input('status_conexao', 'pendente');
        $conexao->save();
    }

    public function edit($id_conexao){
        $conexao = Conexao::find($id_conexao);
        return view('conexao.edit', compact('conexao'));
    }

    public function update(Request $request, $id_conexao){
        $conexao = Conexao::find($id_conexao);
        $conexao->id_gameficacao = $request->input('id_gameficacao');
        $conexao->id_gameficacao_conexao = $request->input('id_gameficacao_conexao');
        $conexao->status_conexao = $request->input('status_conexao', $conexao->status_conexao);
        $conexao->save();
        return true;
    }

    public function destroy($id_conexao){
        $conexao = Conexao::find($id_conexao);
        $conexao->delete();
        return true;
    }

    public function show($id_conexao){
        $conexao = Conexao::find($id_conexao);
        return view('conexao.show', compact('conexao'));
    }

    public function index(){
        $conexoes = Conexao::all();
        return view('conexao.index', compact('conexoes'));
    }

    public function getByGameficacaoId($id_gameficacao){
        return Conexao::where('id_gameficacao', $id_gameficacao)->get();
    }

    public function getByGameficacaoConexaoId($id_gameficacao_conexao){
        return Conexao::where('id_gameficacao_conexao', $id_gameficacao_conexao)->get();
    }
}
