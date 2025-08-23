<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lugares;

class LugaresController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show', 'getByEnderecoId']);
    }

    // Exibir formulário de criação
    public function create()
    {
        return view('lugares.create');
    }

    // Armazenar novo lugar
    public function store(Request $request)
    {
        $request->validate([
            'id_endereco' => 'required|integer|exists:endereco,id_endereco',
            'nome_lugares' => 'required|string|max:255',
            'id_administrador' => 'required|integer|exists:usuario,id_usuario',
        ]);

        $lugar = new Lugares();
        $lugar->id_endereco = $request->input('id_endereco');
        $lugar->nome_lugares = $request->input('nome_lugares');
        $lugar->id_administrador = $request->input('id_administrador');
        $lugar->save();

        return response()->json([
            'success' => true,
            'id_lugar' => $lugar->id_lugar,
            'nome_lugares' => $lugar->nome_lugares,
        ]);
    }

    // Exibir formulário de edição
    public function edit($id_lugar)
    {
        $lugar = Lugares::findOrFail($id_lugar);
        return view('lugares.edit', compact('lugar'));
    }

    // Atualizar lugar
    public function update(Request $request, $id_lugar)
    {
        $lugar = Lugares::findOrFail($id_lugar);

        $request->validate([
            'id_endereco' => 'nullable|integer|exists:endereco,id_endereco',
            'nome_lugares' => 'nullable|string|max:255',
            'id_administrador' => 'nullable|integer|exists:usuario,id_usuario',
        ]);

        $lugar->id_endereco = $request->input('id_endereco', $lugar->id_endereco);
        $lugar->nome_lugares = $request->input('nome_lugares', $lugar->nome_lugares);
        $lugar->id_administrador = $request->input('id_administrador', $lugar->id_administrador);
        $lugar->save();

        return response()->json(['success' => true]);
    }

    // Excluir lugar
    public function destroy($id_lugar)
    {
        $lugar = Lugares::findOrFail($id_lugar);
        $lugar->delete();

        return response()->json(['success' => true]);
    }

    // Mostrar detalhes de um lugar
    public function show($id_lugar)
    {
        $lugar = Lugares::findOrFail($id_lugar);
        return view('lugares.show', compact('lugar'));
    }

    // Listar todos os lugares
    public function index()
    {
        $lugares = Lugares::all();
        return view('lugares.index', compact('lugares'));
    }

    // Buscar lugares por id_endereco
    public function getByEnderecoId($id_endereco)
    {
        $lugares = Lugares::where('id_endereco', $id_endereco)->get();
        return response()->json($lugares);
    }
}
