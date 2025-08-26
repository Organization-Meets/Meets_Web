<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comentarios;

class ComentariosController extends Controller
{
    public function create()
    {
        return view('comentarios.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'descricao_comentario' => 'required|string',
            'id_usuario' => 'required|integer|exists:users,id',
            'id_atividade' => 'required|integer|exists:atividades,id_atividade',
        ]);

        $comentario = new Comentarios();
        $comentario->descricao_comentario = $request->input('descricao_comentario');
        $comentario->id_usuario = $request->input('id_usuario');
        $comentario->id_atividade = $request->input('id_atividade');
        $comentario->save();

        return response()->json([
            'success' => true,
            'id_comentario' => $comentario->id_comentario
        ]);
    }

    public function edit($id_comentario)
    {
        $comentario = Comentarios::findOrFail($id_comentario);
        return view('comentarios.edit', compact('comentario'));
    }

    public function update(Request $request, $id_comentario)
    {
        $request->validate([
            'descricao_comentario' => 'required|string',
            'id_usuario' => 'required|integer|exists:users,id',
            'id_atividade' => 'required|integer|exists:atividades,id_atividade',
        ]);

        $comentario = Comentarios::findOrFail($id_comentario);
        $comentario->descricao_comentario = $request->input('descricao_comentario');
        $comentario->id_usuario = $request->input('id_usuario');
        $comentario->id_atividade = $request->input('id_atividade');
        $comentario->save();

        return response()->json(['success' => true]);
    }

    public function destroy($id_comentario)
    {
        $comentario = Comentarios::findOrFail($id_comentario);
        $comentario->delete();

        return response()->json(['success' => true]);
    }

    public function show($id_comentario)
    {
        $comentario = Comentarios::findOrFail($id_comentario);
        return view('comentarios.show', compact('comentario'));
    }

    public function index()
    {
        $comentarios = Comentarios::all();
        return view('comentarios.index', compact('comentarios'));
    }

    public function getByUsuarioId($id_usuario)
    {
        $comentarios = Comentarios::where('id_usuario', $id_usuario)->get();
        return response()->json($comentarios);
    }
}
