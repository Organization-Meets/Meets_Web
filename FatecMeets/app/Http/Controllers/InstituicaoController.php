<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Instituicao;

class InstituicaoController extends Controller
{
    public function create(){
        return view('instituicao.create');
    }

    public function store(Request $request){
        $instituicao = new Instituicao();
        $instituicao->nome_instituicao = $request->input('nome_instituicao');
        $instituicao->codigo_institucional = $request->input('codigo_institucional');
        $instituicao->save();
    }

    public function edit($id_instituicao){
        $instituicao = Instituicao::find($id_instituicao);
        return view('instituicao.edit', compact('instituicao'));
    }

    public function update(Request $request, $id_instituicao){
        $instituicao = Instituicao::find($id_instituicao);
        $instituicao->nome_instituicao = $request->input('nome_instituicao');
        $instituicao->codigo_institucional = $request->input('codigo_institucional');
        $instituicao->save();
        return true;
    }

    public function destroy($id_instituicao){
        $instituicao = Instituicao::find($id_instituicao);
        $instituicao->delete();
        return true;
    }

    public function show($id_instituicao){
        $instituicao = Instituicao::find($id_instituicao);
        return view('instituicao.show', compact('instituicao'));
    }

    public function index(){
        $instituicoes = Instituicao::all();
        return view('instituicao.index', compact('instituicoes'));
    }
}
