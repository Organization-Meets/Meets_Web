<?php

namespace App\Http\Controllers;

use App\Models\Academico;
use Illuminate\Http\Request;

class AcademicoController extends Controller
{
    public function __construct()
    {
        // Apenas usuários autenticados podem criar, atualizar ou deletar
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index()
    {
        return response()->json(Academico::all());
    }

    public function show($id)
    {
        return response()->json(Academico::findOrFail($id));
    }

    public function store(Request $request)
    {
        $obj = Academico::create($request->all());
        return response()->json($obj, 201);
    }

    public function update(Request $request, $id)
    {
        $obj = Academico::findOrFail($id);
        $obj->update($request->all());
        return response()->json($obj);
    }

    public function destroy($id)
    {
        Academico::destroy($id);
        return response()->json(null, 204);
    }
}
