<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdicionaisController extends Controller
{
    public function create(){
        return view('adicionais.create');
    }

    public function store(Request $request){
        $adicionais = new Adicionais();
        $adicionais->id_usuario = $request->input('id_usuario');
        $adicionais->id_telefone = $request->input('id_telefone');
        $adicionais->id_endereco = $request->input('id_endereco');
        $adicionais->id_instituicao = $request->input('id_instituicao');
    }
}
