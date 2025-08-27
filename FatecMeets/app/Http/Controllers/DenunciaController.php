<?php

namespace App\Http\Controllers;

use App\Models\Denuncia;
use Illuminate\Http\Request;

class DenunciaController extends Controller
{
    public function __construct()
    {
        // Apenas usuários autenticados podem criar, atualizar ou deletar
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index()
    {
        return response()->json(Denuncia::all());
    }

    public function show($id)
    {
        return response()->json(Denuncia::findOrFail($id));
    }

    public function store(Request $request)
    {
        $obj = Denuncia::create($request->all());
        return response()->json($obj, 201);
    }

    public function update(Request $request, $id)
    {
        $obj = Denuncia::findOrFail($id);
        $obj->update($request->all());
        return response()->json($obj);
    }

    public function destroy($id)
    {
        Denuncia::destroy($id);
        return response()->json(null, 204);
    }
}
