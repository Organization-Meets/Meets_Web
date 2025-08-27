<?php

namespace App\Http\Controllers;

use App\Models\Adicional;
use Illuminate\Http\Request;

class AdicionalController extends Controller
{
    public function __construct()
    {
        // Apenas usuários autenticados podem criar, atualizar ou deletar
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index()
    {
        return response()->json(Adicional::all());
    }

    public function show($id)
    {
        return response()->json(Adicional::findOrFail($id));
    }

    public function store(Request $request)
    {
        $obj = Adicional::create($request->all());
        return response()->json($obj, 201);
    }

    public function update(Request $request, $id)
    {
        $obj = Adicional::findOrFail($id);
        $obj->update($request->all());
        return response()->json($obj);
    }

    public function destroy($id)
    {
        Adicional::destroy($id);
        return response()->json(null, 204);
    }
}
