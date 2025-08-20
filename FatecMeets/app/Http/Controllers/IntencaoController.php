<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Intencao;

class IntencaoController extends Controller
{
    public function create(){
        return view('intencao.create');
    }

    public function store(Request $request){
        $intencao = new Intencao();
        $intencao->id_evento = $request->input('id_evento');
        $intencao->id_usuario = $request->input('id_usuario');
        $intencao->status_intencao = $request->input('status_intencao', 'interessado');
        $intencao->save();
    }

    public function edit($id_intencao){
        $intencao = Intencao::find($id_intencao);
        return view('intencao.edit', compact('intencao'));
    }

    public function update(Request $request, $id_intencao){
        $intencao = Intencao::find($id_intencao);
        $intencao->id_evento = $request->input('id_evento');
        $intencao->id_usuario = $request->input('id_usuario');
        $intencao->status_intencao = $request->input('status_intencao', $intencao->status_intencao);
        $intencao->save();
        return true;
    }

    public function destroy($id_intencao){
        $intencao = Intencao::find($id_intencao);
        $intencao->delete();
        return true;
    }

    public function show($id_intencao){
        $intencao = Intencao::find($id_intencao);
        return view('intencao.show', compact('intencao'));
    }

    public function index(){
        $intencoes = Intencao::all();
        return view('intencao.index', compact('intencoes'));
    }

    public function getByUsuarioId($id_usuario){
        return Intencao::where('id_usuario', $id_usuario)->get();
    }

    public function getByEventoId($id_evento){
        return Intencao::where('id_evento', $id_evento)->get();
    }
}
