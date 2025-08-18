<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Gameficacao; // Importa o modelo Gameficacao
use App\Models\Usuario; // Importa o modelo Usuario

class GameficacaoController extends Controller
{
    public function store(Request $request, $usuario_id)
    {
        $gameficacao = new Gameficacao;
        $gameficacao->nickname = $request->input('nickname');
        $gameficacao->score_total = 0;
        $gameficacao->id_usuario = $usuario_id; // Associa o gameficação ao usuário
        $gameficacao->save();
    }
    public function show()
    {
        
    }

}

