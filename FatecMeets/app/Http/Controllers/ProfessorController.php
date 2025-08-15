<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfessorController extends Controller
{
    public function store(Request $request)
    {
        // Validação dos dados do professor
        $request->validate([
            'nome' => 'required|string|max:100',
            'email' => 'required|string|email|max:100',
            'senha' => 'required|string|min:6',
        ]);

        // Criação do professor
        $professor = new Professor;
        $professor->nome = $request->input('nome');
        $professor->email = $request->input('email');
        $professor->senha = Hash::make($request->input('senha'));
        $professor->save();

        return $professor; // Retorna o professor criado
    }
    
}
