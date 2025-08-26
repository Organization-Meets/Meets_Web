<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Membros;

class MembrosController extends Controller
{
    public function create()
    {
        return view('membros.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_chat'        => 'required|integer|exists:chats,id_chat',
            'id_gameficacao' => 'required|integer|exists:gameficacoes,id_gameficacao',
            'status_membro'  => 'nullable|string|in:ativo,inativo,banido',
        ]);

        $membro = new Membros();
        $membro->id_chat = $request->input('id_chat');
        $membro->id_gameficacao = $request->input('id_gameficacao');
        $membro->status_membro = $request->input('status_membro', 'ativo');
        $membro->save();

        return response()->json([
            'success'   => true,
            'id_membro' => $membro->id_membros
        ]);
    }

    public function edit($id_membros)
    {
        $membro = Membros::findOrFail($id_membros);
        return view('membros.edit', compact('membro'));
    }

    public function update(Request $request, $id_membros)
    {
        $request->validate([
            'id_chat'        => 'required|integer|exists:chats,id_chat',
            'id_gameficacao' => 'required|integer|exists:gameficacoes,id_gameficacao',
            'status_membro'  => 'nullable|string|in:ativo,inativo,banido',
        ]);

        $membro = Membros::findOrFail($id_membros);
        $membro->id_chat = $request->input('id_chat');
        $membro->id_gameficacao = $request->input('id_gameficacao');
        $membro->status_membro = $request->input('status_membro', $membro->status_membro);
        $membro->save();

        return response()->json(['success' => true]);
    }

    public function destroy($id_membros)
    {
        $membro = Membros::findOrFail($id_membros);
        $membro->delete();

        return response()->json(['success' => true]);
    }

    public function show($id_membros)
    {
        $membro = Membros::findOrFail($id_membros);
        return view('membros.show', compact('membro'));
    }

    public function index()
    {
        $membros = Membros::all();
        return view('membros.index', compact('membros'));
    }

    public function getByChatId($id_chat)
    {
        return Membros::where('id_chat', $id_chat)->get();
    }

    public function getByGameficacaoId($id_gameficacao)
    {
        return Membros::where('id_gameficacao', $id_gameficacao)->get();
    }
}
