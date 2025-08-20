<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Adicionais;

class AdicionaisController extends Controller
{
    public function create(){
        return view('adicionais.create');
    }

    public function store(Request $request, $usuario_id){
        $adicionais = new Adicionais();
        $adicionais->id_usuario = $usuario_id;
        $adicionais->id_telefone = $request->input('id_telefone');
        $adicionais->id_endereco = $request->input('id_endereco');
        $adicionais->id_instituicao = $request->input('id_instituicao');
        $adicionais->save();
    }
    public function edit($id_adicionais){
        $adicionais = Adicionais::find($id_adicionais);
        return view('adicionais.edit', compact('adicionais'));
    }
    public function update(Request $request, $id_adicionais){
        $adicionais = Adicionais::find($id_adicionais);
        $adicionais->id_telefone = $request->input('id_telefone');
        $adicionais->id_endereco = $request->input('id_endereco');
        $adicionais->id_instituicao = $request->input('id_instituicao');
        $adicionais->save();
        return true;
    }
    public function destroy($id_adicionais){
        $adicionais = Adicionais::find($id_adicionais);
        $adicionais->delete();
        return true;
    }
    public function show($id_adicionais){
        $adicionais = Adicionais::find($id_adicionais);
        return view('adicionais.show', compact('adicionais'));
    }
    public function index(){
        $adicionais = Adicionais::all();
        return view('adicionais.index', compact('adicionais'));
    }
    public function getByUsuarioId($usuario_id){
        return Adicionais::where('id_usuario', $usuario_id)->get();
    }
}
