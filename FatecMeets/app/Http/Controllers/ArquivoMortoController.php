<?php

namespace App\Http\Controllers;

use App\Models\ArquivoMorto;
use Illuminate\Http\Request;

class ArquivoMortoController extends Controller
{
    public function __construct()
    {
        // Apenas usuários autenticados podem criar, atualizar ou deletar
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index()
    {
        return response()->json(ArquivoMorto::all());
    }

    public function show($id)
    {
        return response()->json(ArquivoMorto::findOrFail($id));
    }

    public function store(Request $request)
    {
        $obj = ArquivoMorto::create($request->all());
        return response()->json($obj, 201);
    }

    public function update(Request $request, $id)
    {
        $obj = ArquivoMorto::findOrFail($id);
        $obj->update($request->all());
        return response()->json($obj);
    }

    public function destroy($id)
    {
        ArquivoMorto::destroy($id);
        return response()->json(null, 204);
    }
}
