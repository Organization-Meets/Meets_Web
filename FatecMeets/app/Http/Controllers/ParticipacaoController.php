<?php

namespace App\Http\Controllers;

use App\Models\Participacao;
use Illuminate\Http\Request;

class ParticipacaoController extends Controller
{
    public function __construct()
    {
        // Apenas usuários autenticados podem criar, atualizar ou deletar
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index()
    {
        return response()->json(Participacao::all());
    }

    public function show($id)
    {
        return response()->json(Participacao::findOrFail($id));
    }

    public function store(Request $request)
    {
        $obj = Participacao::create($request->all());
        return response()->json($obj, 201);
    }

    public function update(Request $request, $id)
    {
        $obj = Participacao::findOrFail($id);
        $obj->update($request->all());
        return response()->json($obj);
    }

    public function destroy($id)
    {
        Participacao::destroy($id);
        return response()->json(null, 204);
    }
}
