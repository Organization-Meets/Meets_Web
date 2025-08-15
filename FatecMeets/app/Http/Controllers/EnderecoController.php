<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario; // Importa o modelo Usuario
use App\Models\Endereco; // Importa o modelo Endereco

class EnderecoController extends Controller
{
    public function store(Request $request)
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

        return $endereco; // Retorna o endereço criado
    }
    public function update(Request $request, $id_endereco)
    {
        // Validação dos dados do endereço
        $request->validate([
            'cep' => 'required|string|max:10',
            'numero' => 'required|integer',
            // Adicione outras validações conforme necessário
        ]);

        // Atualização do endereço
        $endereco = Endereco::findOrFail($id_endereco);
        $endereco->cep = $request->input('cep');
        $endereco->numero = $request->input('numero');
        $endereco->save();

        return $endereco;
    }
}