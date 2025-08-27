<?php

namespace App\Http\Controllers;

use App\Models\Gamificacao;
use Illuminate\Http\Request;

class GamificacaoController extends Controller
{
    public function __construct()
    {
        // Apenas usuários autenticados podem criar, atualizar ou deletar
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index()
    {
        return response()->json(Gamificacao::all());
    }

    public function show($id)
    {
        return response()->json(Gamificacao::findOrFail($id));
    }

    public function store(Request $request)
    {
        $obj = Gamificacao::create($request->all());
        return response()->json($obj, 201);
    }

    public function update(Request $request, $id)
    {
        $obj = Gamificacao::findOrFail($id);
        $obj->update($request->all());
        return response()->json($obj);
    }

    public function destroy($id)
    {
        Gamificacao::destroy($id);
        return response()->json(null, 204);
    }
}
