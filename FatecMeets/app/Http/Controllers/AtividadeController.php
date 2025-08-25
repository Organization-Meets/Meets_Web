<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Atividade;

class AtividadeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show', 'getByGamificacaoId', 'store']);
    }

    // Exibir formulário de criação
    public function create()
    {
        return view('atividade.create');
    }

    // Armazenar nova atividade
    public function store(Request $request)
    {
        $validated = $request->validate([
            'likes' => 'nullable|integer|min:0',
            'score' => 'nullable|integer|min:0',
            'tipo_atividade' => 'required|string|max:255',
            'id_gamificacao' => 'required|integer|exists:gameficacao,id_gameficacao',
        ]);

        $atividade = Atividade::create([
            'likes' => $validated['likes'] ?? 0,
            'score' => $validated['score'] ?? 0,
            'tipo_atividade' => $validated['tipo_atividade'],
            'id_gamificacao' => $validated['id_gamificacao'],
        ]);

        return response()->json([
            'success' => true,
            'atividade_id' => $atividade->id_atividade,
            'tipo_atividade' => $atividade->tipo_atividade,
            'score' => $atividade->score,
            'likes' => $atividade->likes,
        ]);
    }

    // Exibir formulário de edição
    public function edit(int $id_atividade)
    {
        $atividade = Atividade::findOrFail($id_atividade);
        return view('atividade.edit', compact('atividade'));
    }

    // Atualizar atividade
    public function update(Request $request, int $id_atividade)
    {
        $atividade = Atividade::findOrFail($id_atividade);

        $validated = $request->validate([
            'likes' => 'nullable|integer|min:0',
            'score' => 'nullable|integer|min:0',
            'tipo_atividade' => 'nullable|string|max:255',
            'id_gamificacao' => 'nullable|integer|exists:gameficacao,id_gameficacao',
        ]);

        $atividade->update([
            'likes' => $validated['likes'] ?? $atividade->likes,
            'score' => $validated['score'] ?? $atividade->score,
            'tipo_atividade' => $validated['tipo_atividade'] ?? $atividade->tipo_atividade,
            'id_gamificacao' => $validated['id_gamificacao'] ?? $atividade->id_gamificacao,
        ]);

        return response()->json(['success' => true]);
    }

    // Excluir atividade
    public function destroy(int $id_atividade)
    {
        $atividade = Atividade::findOrFail($id_atividade);
        $atividade->delete();

        return response()->json(['success' => true]);
    }

    // Mostrar detalhes de uma atividade
    public function show(int $id_atividade, Request $request)
    {
        $atividade = Atividade::findOrFail($id_atividade);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json($atividade);
        }

        return view('atividade.show', compact('atividade'));
    }


    // Listar todas as atividades
    public function index(Request $request)
    {
        $atividades = Atividade::all();

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json($atividades);
        }

        return view('atividade.index', compact('atividades'));
    }


    // Buscar atividades por gamificação (API)
    public function getByGamificacaoId(int $id_gamificacao)
    {
        $atividades = Atividade::where('id_gamificacao', $id_gamificacao)->get();
        return response()->json($atividades);
    }
}
