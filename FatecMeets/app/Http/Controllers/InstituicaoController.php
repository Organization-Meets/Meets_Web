<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Instituicao;

class InstituicaoController extends Controller
{
    public function create()
    {
        return view('instituicao.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome_instituicao'     => 'required|string|max:255',
            'codigo_institucional' => 'required|string|max:50|unique:instituicoes,codigo_institucional',
        ]);

        $instituicao = new Instituicao();
        $instituicao->nome_instituicao = $request->input('nome_instituicao');
        $instituicao->codigo_institucional = $request->input('codigo_institucional');
        $instituicao->save();

        return response()->json([
            'success' => true,
            'id_instituicao' => $instituicao->id_instituicao
        ]);
    }

    public function edit($id_instituicao)
    {
        $instituicao = Instituicao::findOrFail($id_instituicao);
        return view('instituicao.edit', compact('instituicao'));
    }

    public function update(Request $request, $id_instituicao)
    {
        $request->validate([
            'nome_instituicao'     => 'required|string|max:255',
            'codigo_institucional' => 'required|string|max:50|unique:instituicoes,codigo_institucional,' . $id_instituicao . ',id_instituicao',
        ]);

        $instituicao = Instituicao::findOrFail($id_instituicao);
        $instituicao->nome_instituicao = $request->input('nome_instituicao');
        $instituicao->codigo_institucional = $request->input('codigo_institucional');
        $instituicao->save();

        return response()->json(['success' => true]);
    }

    public function destroy($id_instituicao)
    {
        $instituicao = Instituicao::findOrFail($id_instituicao);
        $instituicao->delete();

        return response()->json(['success' => true]);
    }

    public function show($id_instituicao)
    {
        $instituicao = Instituicao::findOrFail($id_instituicao);
        return view('instituicao.show', compact('instituicao'));
    }

    public function index()
    {
        $instituicoes = Instituicao::all();
        return view('instituicao.index', compact('instituicoes'));
    }
}
