<?php

namespace App\Http\Controllers;

use App\Models\Instituicao;
use Illuminate\Http\Request;

class InstituicaoController extends Controller
{
    public function __construct()
    {
        // Apenas usuários autenticados podem criar, atualizar ou deletar
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index()
    {
        return response()->json(Instituicao::all());
    }

    public function show($id)
    {
        return response()->json(Instituicao::findOrFail($id));
    }

    public function store(Request $request)
    {
        $obj = Instituicao::create($request->all());
        return response()->json($obj, 201);
    }

    public function update(Request $request, $id)
    {
        $obj = Instituicao::findOrFail($id);
        $obj->update($request->all());
        return response()->json($obj);
    }

    public function destroy($id)
    {
        Instituicao::destroy($id);
        return response()->json(null, 204);
    }
}
