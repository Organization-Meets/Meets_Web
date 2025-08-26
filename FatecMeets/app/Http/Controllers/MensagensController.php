<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mensagens;

class MensagensController extends Controller
{
    public function create()
    {
        return view('mensagens.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_chat'             => 'required|integer|exists:chats,id_chat',
            'id_gameficacao'      => 'required|integer|exists:gameficacoes,id_gameficacao',
            'descricao_mensagens' => 'required|string|max:1000',
            'data_mensagem'       => 'nullable|date',
        ]);

        $mensagem = new Mensagens();
        $mensagem->id_chat = $request->input('id_chat');
        $mensagem->id_gameficacao = $request->input('id_gameficacao');
        $mensagem->descricao_mensagens = $request->input('descricao_mensagens');
        $mensagem->data_mensagem = $request->input('data_mensagem', now());
        $mensagem->save();

        return response()->json([
            'success'     => true,
            'id_mensagem' => $mensagem->id_mensagens
        ]);
    }

    public function edit($id_mensagens)
    {
        $mensagem = Mensagens::findOrFail($id_mensagens);
        return view('mensagens.edit', compact('mensagem'));
    }

    public function update(Request $request, $id_mensagens)
    {
        $request->validate([
            'id_chat'             => 'required|integer|exists:chats,id_chat',
            'id_gameficacao'      => 'required|integer|exists:gameficacoes,id_gameficacao',
            'descricao_mensagens' => 'required|string|max:1000',
            'data_mensagem'       => 'nullable|date',
        ]);

        $mensagem = Mensagens::findOrFail($id_mensagens);
        $mensagem->id_chat = $request->input('id_chat');
        $mensagem->id_gameficacao = $request->input('id_gameficacao');
        $mensagem->descricao_mensagens = $request->input('descricao_mensagens');
        $mensagem->data_mensagem = $request->input('data_mensagem', $mensagem->data_mensagem);
        $mensagem->save();

        return response()->json(['success' => true]);
    }

    public function destroy($id_mensagens)
    {
        $mensagem = Mensagens::findOrFail($id_mensagens);
        $mensagem->delete();

        return response()->json(['success' => true]);
    }

    public function show($id_mensagens)
    {
        $mensagem = Mensagens::findOrFail($id_mensagens);
        return view('mensagens.show', compact('mensagem'));
    }

    public function index()
    {
        $mensagens = Mensagens::all();
        return view('mensagens.index', compact('mensagens'));
    }

    public function getByChatId($id_chat)
    {
        return Mensagens::where('id_chat', $id_chat)->get();
    }

    public function getByGameficacaoId($id_gameficacao)
    {
        return Mensagens::where('id_gameficacao', $id_gameficacao)->get();
    }
}
