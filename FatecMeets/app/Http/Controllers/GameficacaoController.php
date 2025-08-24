<?php

namespace App\Http\Controllers;

use App\Models\Gameficacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GameficacaoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show', 'getByUsuarioId', 'store']);
    }

    // Formulário de criação
    public function create()
    {
        $nomeArquivo = "createGameficacao";
        return view('gameficacao.create', compact('nomeArquivo'));
    }

    // Armazenar nova gameficação
    public function store(Request $request, $id_usuario)
    {
        $request->validate([
            'nickname' => 'required|string|max:255',
            'score_total' => 'nullable|integer|min:0',
        ]);

        $gameficacao = Gameficacao::create([
            'nickname'    => $request->input('nickname'),
            'score_total' => $request->input('score_total', 0),
            'id_usuario'  => $id_usuario,
        ]);

        return response()->json([
            'success'          => true,
            'id_gameficacao'   => $gameficacao->id_gameficacao,
            'nickname'         => $gameficacao->nickname,
            'score_total'      => $gameficacao->score_total,
        ]);
    }

    // Editar gameficação
    public function edit($id_gameficacao)
    {
        $gameficacao = Gameficacao::findOrFail($id_gameficacao);
        return view('gameficacao.edit', compact('gameficacao'));
    }

    // Atualizar gameficação
    public function update(Request $request, $id_gameficacao)
    {
        $request->validate([
            'nickname'    => 'required|string|max:255',
            'score_total' => 'required|integer|min:0',
        ]);

        $gameficacao = Gameficacao::findOrFail($id_gameficacao);
        $gameficacao->nickname    = $request->input('nickname');
        $gameficacao->score_total = $request->input('score_total');
        $gameficacao->save();

        return response()->json([
            'success'        => true,
            'id_gameficacao' => $gameficacao->id_gameficacao,
        ]);
    }

    // Excluir gameficação
    public function destroy($id_gameficacao)
    {
        $gameficacao = Gameficacao::findOrFail($id_gameficacao);
        $gameficacao->delete();

        return response()->json([
            'success' => true,
            'message' => 'Gameficação excluída com sucesso!'
        ]);
    }

    // Mostrar detalhes
    public function show($id_gameficacao)
    {
        $gameficacao = Gameficacao::findOrFail($id_gameficacao);
        return view('gameficacao.show', compact('gameficacao'));
    }

    // Listar todas
    public function index()
    {
        $gameficacoes = Gameficacao::all();
        return view('gameficacao.index', compact('gameficacoes'));
    }

    // Buscar por usuário logado ou ID
    public function getByUsuarioId($id_usuario = null)
    {
        $id_usuario = $id_usuario ?? Auth::id();
        $gameficacoes = Gameficacao::where('id_usuario', $id_usuario)->get();

        return response()->json($gameficacoes);
    }
}
