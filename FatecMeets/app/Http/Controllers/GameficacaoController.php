<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gameficacao;
use Illuminate\Support\Facades\Auth;

class GameficacaoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    // Exibir formulário de criação
    public function create()
    {
        return view('gameficacao.create');
    }

    // Armazenar nova gameficação
    public function store(Request $request)
    {
        $request->validate([
            'score_total' => 'nullable|integer|min:0',
            'nickname' => 'required|string|max:255',
        ]);

        $gameficacao = new Gameficacao();
        $gameficacao->score_total = $request->input('score_total', 0);
        $gameficacao->nickname = $request->input('nickname');
        $gameficacao->id_usuario = Auth::id();
        $gameficacao->save();

        return response()->json([
            'success' => true,
            'gameficacao_id' => $gameficacao->id_gameficacao,
            'nickname' => $gameficacao->nickname,
            'score_total' => $gameficacao->score_total
        ]);
    }

    // Exibir formulário de edição
    public function edit($id_gameficacao)
    {
        $gameficacao = Gameficacao::findOrFail($id_gameficacao);
        return view('gameficacao.edit', compact('gameficacao'));
    }

    // Atualizar gameficação
    public function update(Request $request, $id_gameficacao)
    {
        $gameficacao = Gameficacao::findOrFail($id_gameficacao);

        $request->validate([
            'score_total' => 'nullable|integer|min:0',
            'nickname' => 'nullable|string|max:255',
        ]);

        $gameficacao->score_total = $request->input('score_total', $gameficacao->score_total);
        $gameficacao->nickname = $request->input('nickname', $gameficacao->nickname);
        $gameficacao->save();

        return response()->json(['success' => true]);
    }

    // Excluir gameficação
    public function destroy($id_gameficacao)
    {
        $gameficacao = Gameficacao::findOrFail($id_gameficacao);
        $gameficacao->delete();

        return response()->json(['success' => true]);
    }

    // Mostrar detalhes de uma gameficação
    public function show($id_gameficacao)
    {
        $gameficacao = Gameficacao::findOrFail($id_gameficacao);
        return view('gameficacao.show', compact('gameficacao'));
    }

    // Listar todas as gameficações
    public function index()
    {
        $gameficacoes = Gameficacao::all();
        return view('gameficacao.index', compact('gameficacoes'));
    }

    // Buscar por usuário logado ou por ID
    public function getByUsuarioId($id_usuario = null)
    {
        $id_usuario = $id_usuario ?? Auth::id();
        $gameficacoes = Gameficacao::where('id_usuario', $id_usuario)->get();

        return response()->json($gameficacoes);
    }
}
