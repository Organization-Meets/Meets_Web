<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Telefone; // Importa o modelo Telefone

class TelefoneController extends Controller
{
    public function store(Request $request)
    {
        // Validação dos dados do telefone
        $request->validate([
            'ddd' => 'required|string|max:3',
            'numero_telefone' => 'required|string|max:15',
        ]);

        // Criação do telefone
        $telefone = new Telefone;
        $telefone->ddd = $request->input('ddd');
        $telefone->numero_telefone = $request->input('numero_telefone');
        $telefone->save();

        return $telefone; // Retorna o telefone criado
    }
    public function update(Request $request, $id_telefone)
    {
        // Validação dos dados do telefone
        $request->validate([
            'ddd' => 'required|string|max:3',
            'numero_telefone' => 'required|string|max:15',
        ]);

        // Atualização do telefone
        $telefone = Telefone::findOrFail($id_telefone);
        $telefone->ddd = $request->input('ddd');
        $telefone->numero_telefone = $request->input('numero_telefone');
        $telefone->save();

        return $telefone; // Retorna o telefone atualizado
    }
}
