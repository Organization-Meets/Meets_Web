<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Membros;

class MembrosController extends Controller
{
    public function create(){
        return view('membros.create');
    }

    public function store(Request $request){
        $membro = new Membros();
        $membro->id_chat = $request->input('id_chat');
        $membro->id_gameficacao = $request->input('id_gameficacao');
        $membro->status_membro = $request->input('status_membro', 'ativo');
        $membro->save();
    }

    public function edit($id_membros){
        $membro = Membros::find($id_membros);
        return view('membros.edit', compact('membro'));
    }

    public function update(Request $request, $id_membros){
        $membro = Membros::find($id_membros);
        $membro->id_chat = $request->input('id_chat');
        $membro->id_gameficacao = $request->input('id_gameficacao');
        $membro->status_membro = $request->input('status_membro', $membro->status_membro);
        $membro->save();
        return true;
    }

    public function destroy($id_membros){
        $membro = Membros::find($id_membros);
        $membro->delete();
        return true;
    }

    public function show($id_membros){
        $membro = Membros::find($id_membros);
        return view('membros.show', compact('membro'));
    }

    public function index(){
        $membros = Membros::all();
        return view('membros.index', compact('membros'));
    }

    public function getByChatId($id_chat){
        return Membros::where('id_chat', $id_chat)->get();
    }

    public function getByGameficacaoId($id_gameficacao){
        return Membros::where('id_gameficacao', $id_gameficacao)->get();
    }
}
