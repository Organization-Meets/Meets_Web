<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Logradouro;

class LogradouroController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show', 'getByEnderecoId']);
    }

    // Exibir formulário de criação
    public function create()
    {
        return view('logradouro.create');
    }

    // Armazenar novo logradouro
    public function store(Request $request)
    {
        $request->validate([
            'id_endereco' => 'required|integer|exists:endereco,id_endereco',
            'nome_logradouro' => 'required|string|max:255',
        ]);

        $logradouro = new Logradouro();
        $logradouro->id_endereco = $request->input('id_endereco');
        $logradouro->nome_logradouro = $request->input('nome_logradouro');
        $logradouro->save();

        return response()->json([
            'success' => true,
            'id_logradouro' => $logradouro->id_logradouro,
            'nome_logradouro' => $logradouro->nome_logradouro,
        ]);
    }

    // Exibir formulário de edição
    public function edit($id_logradouro)
    {
        $logradouro = Logradouro::findOrFail($id_logradouro);
        return view('logradouro.edit', compact('logradouro'));
    }

    // Atualizar logradouro
    public function update(Request $request, $id_logradouro)
    {
        $logradouro = Logradouro::findOrFail($id_logradouro);

        $request->validate([
            'id_endereco' => 'nullable|integer|exists:endereco,id_endereco',
            'nome_logradouro' => 'nullable|string|max:255',
        ]);

        $logradouro->id_endereco = $request->input('id_endereco', $logradouro->id_endereco);
        $logradouro->nome_logradouro = $request->input('nome_logradouro', $logradouro->nome_logradouro);
        $logradouro->save();

        return response()->json(['success' => true]);
    }

    // Excluir logradouro
    public function destroy($id_logradouro)
    {
        $logradouro = Logradouro::findOrFail($id_logradouro);
        $logradouro->delete();

        return response()->json(['success' => true]);
    }

    // Mostrar detalhes de um logradouro
    public function show($id_logradouro)
    {
        $logradouro = Logradouro::findOrFail($id_logradouro);
        return view('logradouro.show', compact('logradouro'));
    }

    // Listar todos os logradouros
    public function index()
    {
        $logradouros = Logradouro::all();
        return view('logradouro.index', compact('logradouros'));
    }

    // Buscar logradouros por id_endereco
    public function getByEnderecoId($id_endereco)
    {
        $logradouros = Logradouro::where('id_endereco', $id_endereco)->get();
        return response()->json($logradouros);
    }
}
