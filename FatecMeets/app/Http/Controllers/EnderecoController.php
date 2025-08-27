<?php

namespace App\Http\Controllers;

use App\Models\Endereco;
use Illuminate\Http\Request;

class EnderecoController extends Controller
{
    public function __construct()
    {
        // Apenas usuários autenticados podem criar, atualizar ou deletar
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index()
    {
        return response()->json(Endereco::all());
    }

    public function show($id)
    {
        return response()->json(Endereco::findOrFail($id));
    }

    public function store(Request $request)
    {
        $obj = Endereco::create($request->all());
        return response()->json($obj, 201);
    }

    public function update(Request $request, $id)
    {
        $obj = Endereco::findOrFail($id);
        $obj->update($request->all());
        return response()->json($obj);
    }

    public function destroy($id)
    {
        Endereco::destroy($id);
        return response()->json(null, 204);
    }
}
