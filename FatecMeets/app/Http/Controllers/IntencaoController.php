<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Intencao;

class IntencaoController extends Controller
{
    public function create()
    {
        return view('intencao.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_evento'  => 'required|integer|exists:eventos,id_evento',
            'id_usuario' => 'required|integer|exists:usuarios,id_usuario',
            'status_intencao' => 'nullable|string|in:interessado,confirmado,recusado',
        ]);

        $intencao = new Intencao();
        $intencao->id_evento = $request->input('id_evento');
        $intencao->id_usuario = $request->input('id_usuario');
        $intencao->status_intencao = $request->input('status_intencao', 'interessado');
        $intencao->save();

        return response()->json([
            'success' => true,
            'id_intencao' => $intencao->id_intencao
        ]);
    }

    public function edit($id_intencao)
    {
        $intencao = Intencao::findOrFail($id_intencao);
        return view('intencao.edit', compact('intencao'));
    }

    public function update(Request $request, $id_intencao)
    {
        $request->validate([
            'id_evento'  => 'required|integer|exists:eventos,id_evento',
            'id_usuario' => 'required|integer|exists:usuarios,id_usuario',
            'status_intencao' => 'nullable|string|in:interessado,confirmado,recusado',
        ]);

        $intencao = Intencao::findOrFail($id_intencao);
        $intencao->id_evento = $request->input('id_evento');
        $intencao->id_usuario = $request->input('id_usuario');
        $intencao->status_intencao = $request->input('status_intencao', $intencao->status_intencao);
        $intencao->save();

        return response()->json(['success' => true]);
    }

    public function destroy($id_intencao)
    {
        $intencao = Intencao::findOrFail($id_intencao);
        $intencao->delete();

        return response()->json(['success' => true]);
    }

    public function show($id_intencao)
    {
        $intencao = Intencao::findOrFail($id_intencao);
        return view('intencao.show', compact('intencao'));
    }

    public function index()
    {
        $intencoes = Intencao::all();
        return view('intencao.index', compact('intencoes'));
    }

    public function getByUsuarioId($id_usuario)
    {
        return Intencao::where('id_usuario', $id_usuario)->get();
    }

    public function getByEventoId($id_evento)
    {
        return Intencao::where('id_evento', $id_evento)->get();
    }
}
