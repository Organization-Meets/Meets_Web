<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Academicos;

class AcademicosController extends Controller
{
    public function create(){
        return view('academicos.create');
    }

    public function store(Request $request){
        $academicos = new Academicos();
        $academicos->id_usuario = $request->input('id_usuario');
        $academicos->nome_academicos = $request->input('nome_academicos');
        $academicos->ra_academicos = $request->input('ra_academicos');
        $academicos->save();

        return redirect()->route('academicos.index');
    }
}
