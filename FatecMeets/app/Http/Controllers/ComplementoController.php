<?php

namespace App\Http\Controllers;

use App\Models\Complemento;
use Illuminate\Http\Request;

class ComplementoController extends Controller
{
    public function __construct()
    {
        // Apenas usuários autenticados podem criar, atualizar ou deletar
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index()
    {
        return response()->json(Complemento::all());
    }

    public function show($id)
    {
        return response()->json(Complemento::findOrFail($id));
    }

    public function store(Request $request)
    {
        $obj = Complemento::create($request->all());
        return response()->json($obj, 201);
    }

    public function update(Request $request, $id)
    {
        $obj = Complemento::findOrFail($id);
        $obj->update($request->all());
        return response()->json($obj);
    }

    public function destroy($id)
    {
        Complemento::destroy($id);
        return response()->json(null, 204);
    }
}
