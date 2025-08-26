<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Conexao;

class ConexaoController extends Controller
{
    public function create()
    {
        return view('conexao.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_gameficacao' => 'required|integer|exists:gameficacoes,id_gameficacao',
            'id_gameficacao_conexao' => 'required|integer|exists:gameficacoes,id_gameficacao',
            'status_conexao' => 'nullable|string|in:pendente,aceita,rejeitada'
        ]);

        $conexao = new Conexao();
        $conexao->id_gameficacao = $request->input('id_gameficacao');
        $conexao->id_gameficacao_conexao = $request->input('id_gameficacao_conexao');
        $conexao->status_conexao = $request->input('status_conexao', 'pendente');
        $conexao->save();

        return response()->json([
            'success' => true,
            'id_conexao' => $conexao->id_conexao
        ]);
    }

    public function edit($id_conexao)
    {
        $conexao = Conexao::findOrFail($id_conexao);
        return view('conexao.edit', compact('conexao'));
    }

    public function update(Request $request, $id_conexao)
    {
        $request->validate([
            'id_gameficacao' => 'required|integer|exists:gameficacoes,id_gameficacao',
            'id_gameficacao_conexao' => 'required|integer|exists:gameficacoes,id_gameficacao',
            'status_conexao' => 'nullable|string|in:pendente,aceita,rejeitada'
        ]);

        $conexao = Conexao::findOrFail($id_conexao);
        $conexao->id_gameficacao = $request->input('id_gameficacao');
        $conexao->id_gameficacao_conexao = $request->input('id_gameficacao_conexao');
        $conexao->status_conexao = $request->input('status_conexao', $conexao->status_conexao);
        $conexao->save();

        return response()->json(['success' => true]);
    }

    public function destroy($id_conexao)
    {
        $conexao = Conexao::findOrFail($id_conexao);
        $conexao->delete();

        return response()->json(['success' => true]);
    }

    public function show($id_conexao)
    {
        $conexao = Conexao::findOrFail($id_conexao);
        return view('conexao.show', compact('conexao'));
    }

    public function index()
    {
        $conexoes = Conexao::all();
        return view('conexao.index', compact('conexoes'));
    }

    public function getByGameficacaoId($id_gameficacao)
    {
        $conexoes = Conexao::where('id_gameficacao', $id_gameficacao)->get();
        return response()->json($conexoes);
    }

    public function getByGameficacaoConexaoId($id_gameficacao_conexao)
    {
        $conexoes = Conexao::where('id_gameficacao_conexao', $id_gameficacao_conexao)->get();
        return response()->json($conexoes);
    }
}
