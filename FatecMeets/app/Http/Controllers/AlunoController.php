<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use Illuminate\Http\Request;

class AlunoController extends Controller
{
    public function __construct()
    {
        // Apenas usuários autenticados podem criar, atualizar ou deletar
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index()
    {
        return response()->json(Aluno::all());
    }

    public function show($id)
    {
        return response()->json(Aluno::findOrFail($id));
    }

    public function store(Request $request)
    {
        $obj = Aluno::create($request->all());
        return response()->json($obj, 201);
    }

    public function update(Request $request, $id)
    {
        $obj = Aluno::findOrFail($id);
        $obj->update($request->all());
        return response()->json($obj);
    }

    public function destroy($id)
    {
        Aluno::destroy($id);
        return response()->json(null, 204);
    }
}
