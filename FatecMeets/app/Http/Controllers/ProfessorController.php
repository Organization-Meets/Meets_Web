<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Professor; // Importa o modelo Professor
use App\Models\Usuario; // Importa o modelo Usuario

class ProfessorController extends Controller
{
    public function store(Request $request)
    {
        // Validação dos dados do professor
        $request->validate([
            'nome_professor' => 'required|string|max:100',
            'ra_professor' => 'required|integer',
        ]);

        // Criação do professor
        $professor = new Professor;
        $professor->nome_professor = $request->input('nome_professor');
        $professor->ra_professor = $request->input('ra_professor');
        $professor->id_usuario =  $usuario->id_usuario;
        $professor->save();

        return $professor; // Retorna o professor criado
    }

}
