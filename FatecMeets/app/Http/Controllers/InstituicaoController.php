<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InstituicaoController extends Controller
{
    public function create()
    {
        return view('administradores.create_instituicao');
    }

    public function store(Request $request)
    {
        $nomeInstituicao = $request->input('nome_instituicao');
        $codigoInstitucional = $request->input('codigo_institucional');

        // Lógica para armazenar a instituição
    }
}
