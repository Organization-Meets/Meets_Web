<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lixo;

class LixoController extends Controller
{
    public function create(){
        return view('lixo.create');
    }

    public function store(Request $request){
        $lixo = new Lixo();
        $lixo->id_usuario = $request->input('id_usuario');
        $lixo->tabela_origem = $request->input('tabela_origem');
        $lixo->id_registro_origem = $request->input('id_registro_origem');
        $lixo->motivo_exclusao = $request->input('motivo_exclusao');
        $lixo->dados_tabela = $request->input('dados_tabela');
        $lixo->save();
    }

    public function edit($id_lixo){
        $lixo = Lixo::find($id_lixo);
        return view('lixo.edit', compact('lixo'));
    }

    public function update(Request $request, $id_lixo){
        $lixo = Lixo::find($id_lixo);
        $lixo->id_usuario = $request->input('id_usuario');
        $lixo->tabela_origem = $request->input('tabela_origem');
        $lixo->id_registro_origem = $request->input('id_registro_origem');
        $lixo->motivo_exclusao = $request->input('motivo_exclusao');
        $lixo->dados_tabela = $request->input('dados_tabela');
        $lixo->save();
        return true;
    }

    public function destroy($id_lixo){
        $lixo = Lixo::find($id_lixo);
        $lixo->delete();
        return true;
    }

    public function show($id_lixo){
        $lixo = Lixo::find($id_lixo);
        return view('lixo.show', compact('lixo'));
    }

    public function index(){
        $lixos = Lixo::all();
        return view('lixo.index', compact('lixos'));
    }

    public function getByUsuarioId($id_usuario){
        return Lixo::where('id_usuario', $id_usuario)->get();
    }
}
