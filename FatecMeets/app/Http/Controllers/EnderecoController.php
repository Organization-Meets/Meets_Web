<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Endereco;

class EnderecoController extends Controller
{
    public function create()
    {
        return view('endereco.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'numero' => 'required|string|max:10',
            'cep' => 'required|string|regex:/^\d{5}-?\d{3}$/'
        ]);

        $endereco = new Endereco();
        $endereco->numero = $request->input('numero');
        $endereco->cep = $request->input('cep');
        $endereco->save();

        return response()->json([
            'success' => true,
            'id_endereco' => $endereco->id_endereco
        ]);
    }

    public function edit($id_endereco)
    {
        $endereco = Endereco::findOrFail($id_endereco);
        return view('endereco.edit', compact('endereco'));
    }

    public function update(Request $request, $id_endereco)
    {
        $request->validate([
            'numero' => 'required|string|max:10',
            'cep' => 'required|string|regex:/^\d{5}-?\d{3}$/'
        ]);

        $endereco = Endereco::findOrFail($id_endereco);
        $endereco->numero = $request->input('numero');
        $endereco->cep = $request->input('cep');
        $endereco->save();

        return response()->json(['success' => true]);
    }

    public function destroy($id_endereco)
    {
        $endereco = Endereco::findOrFail($id_endereco);
        $endereco->delete();

        return response()->json(['success' => true]);
    }

    public function show($id_endereco)
    {
        $endereco = Endereco::findOrFail($id_endereco);
        return view('endereco.show', compact('endereco'));
    }

    public function index()
    {
        $enderecos = Endereco::all();
        return view('endereco.index', compact('enderecos'));
    }
}
