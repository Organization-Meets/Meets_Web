<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario; // Importa o modelo Usuario
use App\Models\Endereco; // Importa o modelo Endereco

class EnderecoController extends Controller
{
    // Método para criar um novo endereço
    public function create(Request $request)
    {
        // Validação dos dados do endereço
        $request->validate([
            'cep' => 'required|string|max:10',
            'numero' => 'required|integer',
            // Adicione outras validações conforme necessário
        ]);

        // Criação do endereço (supondo que você tenha um modelo Endereco)
        $endereco = new Endereco;
        $endereco->cep = $request->input('cep');
        $endereco->numero = $request->input('numero');
        $endereco->save();

        return redirect()->route('usuarios.create')->with('success', 'Endereço criado com sucesso!');
    }
}
