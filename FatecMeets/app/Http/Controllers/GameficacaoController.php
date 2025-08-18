<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Usuario; // Importa o modelo Usuario

class GameficacaoController extends Controller
{
    public function store(Request $request)
    {
        $gameficacao = new Gameficacao;
        $gameficacao->nickname = $request->input('nickname');
        $gameficacao->score_total = 0;
        $gameficacao->id_usuario = $usuario->id_usuario; // Associa o gameficação ao usuário
        $gameficacao->save();

        return $gameficacao;
    }
    public function show()
    {
        
    }

}

