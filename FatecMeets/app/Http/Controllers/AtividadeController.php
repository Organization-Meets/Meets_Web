<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Atividade;
use Illuminate\Support\Facades\Auth;

class AtividadeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    // Exibir formulário de criação
    public function create()
    {
        return view('atividade.create');
    }

    // Armazenar nova atividade
    public function store(Request $request)
    {
        $request->validate([
            'likes' => 'nullable|integer|min:0',
            'score' => 'nullable|integer|min:0',
            'tipo_atividade' => 'required|string|max:255',
            'id_gamificacao' => 'required|integer|exists:gameficacao,id_gameficacao',
        ]);

        $atividade = new Atividade();
        $atividade->likes = $request->input('likes', 0);
        $atividade->score = $request->input('score', 0);
        $atividade->tipo_atividade = $request->input('tipo_atividade');
        $atividade->id_gamificacao = $request->input('id_gamificacao');
        $atividade->save();

        return response()->json([
            'success' => true,
            'atividade_id' => $atividade->id_atividade,
            'tipo_atividade' => $atividade->tipo_atividade,
            'score' => $atividade->score,
            'likes' => $atividade->likes,
        ]);
    }

    // Exibir formulário de edição
    public function edit($id_atividade)
    {
        $atividade = Atividade::findOrFail($id_atividade);
        return view('atividade.edit', compact('atividade'));
    }

    // Atualizar atividade
    public function update(Request $request, $id_atividade)
    {
        $atividade = Atividade::findOrFail($id_atividade);

        $request->validate([
            'likes' => 'nullable|integer|min:0',
            'score' => 'nullable|integer|min:0',
            'tipo_atividade' => 'nullable|string|max:255',
            'id_gamificacao' => 'nullable|integer|exists:gameficacao,id_gameficacao',
        ]);

        $atividade->likes = $request->input('likes', $atividade->likes);
        $atividade->score = $request->input('score', $atividade->score);
        $atividade->tipo_atividade = $request->input('tipo_atividade', $atividade->tipo_atividade);
        $atividade->id_gamificacao = $request->input('id_gamificacao', $atividade->id_gamificacao);
        $atividade->save();

        return response()->json(['success' => true]);
    }

    // Excluir atividade
    public function destroy($id_atividade)
    {
        $atividade = Atividade::findOrFail($id_atividade);
        $atividade->delete();

        return response()->json(['success' => true]);
    }

    // Mostrar detalhes de uma atividade
    public function show($id_atividade)
    {
        $atividade = Atividade::findOrFail($id_atividade);
        return view('atividade.show', compact('atividade'));
    }

    // Listar todas as atividades
    public function index()
    {
        $atividades = Atividade::all();
        return view('atividade.index', compact('atividades'));
    }

    // Buscar atividades por gamificação
    public function getByGamificacaoId($id_gamificacao)
    {
        $atividades = Atividade::where('id_gamificacao', $id_gamificacao)->get();
        return response()->json($atividades);
    }
}