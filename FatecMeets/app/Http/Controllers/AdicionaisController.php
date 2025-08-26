<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Adicionais;

class AdicionaisController extends Controller
{
    public function create()
    {
        $nomeArquivo = "createAdicionais";
        return view('adicionais.create', compact('nomeArquivo'));
    }

    public function store(Request $request, $usuario_id)
    {
        $request->validate([
            'id_telefone' => 'nullable|integer',
            'id_endereco' => 'nullable|integer',
            'id_instituicao' => 'nullable|integer',
        ]);

        $adicionais = new Adicionais();
        $adicionais->id_usuario = $usuario_id;
        $adicionais->id_telefone = $request->input('id_telefone');
        $adicionais->id_endereco = $request->input('id_endereco');
        $adicionais->id_instituicao = $request->input('id_instituicao');
        $adicionais->save();

        return response()->json([
            'success' => true,
            'message' => 'Adicionais salvos com sucesso!',
            'adicionais' => $adicionais
        ]);
    }

    public function edit($id_adicionais)
    {
        $adicionais = Adicionais::findOrFail($id_adicionais);
        return view('adicionais.edit', compact('adicionais'));
    }

    public function update(Request $request, $id_adicionais)
    {
        $request->validate([
            'id_telefone' => 'nullable|integer',
            'id_endereco' => 'nullable|integer',
            'id_instituicao' => 'nullable|integer',
        ]);

        $adicionais = Adicionais::findOrFail($id_adicionais);
        $adicionais->id_telefone = $request->input('id_telefone');
        $adicionais->id_endereco = $request->input('id_endereco');
        $adicionais->id_instituicao = $request->input('id_instituicao');
        $adicionais->save();

        return response()->json([
            'success' => true,
            'message' => 'Adicionais atualizados com sucesso!',
            'adicionais' => $adicionais
        ]);
    }

    public function destroy($id_adicionais)
    {
        $adicionais = Adicionais::findOrFail($id_adicionais);
        $adicionais->delete();

        return response()->json([
            'success' => true,
            'message' => 'Adicionais removidos com sucesso!'
        ]);
    }

    public function show($id_adicionais)
    {
        $adicionais = Adicionais::findOrFail($id_adicionais);
        return view('adicionais.show', compact('adicionais'));
    }

    public function index()
    {
        $adicionais = Adicionais::all();
        return view('adicionais.index', compact('adicionais'));
    }

    public function getByUsuarioId($usuario_id)
    {
        $adicionais = Adicionais::where('id_usuario', $usuario_id)->get();

        if ($adicionais->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Nenhum adicional encontrado para este usuário.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'adicionais' => $adicionais
        ]);
    }
}
