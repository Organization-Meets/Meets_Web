<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LugaresController extends Controller
{
    public function index()
    {
        // This method will return a view with a list of places
        return view('lugares.index');
    }
    public function create()
    {
        return view('lugares.create');
    }
    public function store(Request $request)
    {
        $idEndereco = $request->input('id_endereco');
        $nomeLugares = $request->input('nome_lugares');
        $idAdministrador = $request->input('id_administrador');

    }
}