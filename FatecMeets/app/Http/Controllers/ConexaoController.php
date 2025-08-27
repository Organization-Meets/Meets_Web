<?php

namespace App\Http\Controllers;

use App\Models\Conexao;
use Illuminate\Http\Request;

class ConexaoController extends Controller
{
    public function __construct()
    {
        // Apenas usuários autenticados podem criar, atualizar ou deletar
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index()
    {
        return response()->json(Conexao::all());
    }

    public function show($id)
    {
        return response()->json(Conexao::findOrFail($id));
    }

    public function store(Request $request)
    {
        $obj = Conexao::create($request->all());
        return response()->json($obj, 201);
    }

    public function update(Request $request, $id)
    {
        $obj = Conexao::findOrFail($id);
        $obj->update($request->all());
        return response()->json($obj);
    }

    public function destroy($id)
    {
        Conexao::destroy($id);
        return response()->json(null, 204);
    }
}
