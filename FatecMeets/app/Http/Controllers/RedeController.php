<?php

namespace App\Http\Controllers;

use App\Models\Rede;
use Illuminate\Http\Request;

class RedeController extends Controller
{
    public function __construct()
    {
        // Apenas usuários autenticados podem criar, atualizar ou deletar
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index()
    {
        return response()->json(Rede::all());
    }

    public function show($id)
    {
        return response()->json(Rede::findOrFail($id));
    }

    public function store(Request $request)
    {
        $obj = Rede::create($request->all());
        return response()->json($obj, 201);
    }

    public function update(Request $request, $id)
    {
        $obj = Rede::findOrFail($id);
        $obj->update($request->all());
        return response()->json($obj);
    }

    public function destroy($id)
    {
        Rede::destroy($id);
        return response()->json(null, 204);
    }
}
