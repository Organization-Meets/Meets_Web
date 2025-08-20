<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Academicos;

class AcademicosController extends Controller
{
    public function create(){
        return view('academicos.create');
    }

    public function store(Request $request, $usuario_id){
        $academicos = new Academicos();
        $academicos->id_usuario = $usuario_id;
        $academicos->nome_academicos = $request->input('nome_academicos');
        $academicos->ra_academicos = $request->input('ra_academicos');
        $academicos->save();
    }
    public function edit($id_academicos){
        $academicos = Academicos::find($id_academicos);
        return view('academicos.edit', compact('academicos'));
    }
    public function update(Request $request, $id_academicos){
        $academicos = Academicos::find($id_academicos);
        $academicos->nome_academicos = $request->input('nome_academicos');
        $academicos->ra_academicos = $request->input('ra_academicos');
        $academicos->save();
        return true;
    }
    public function destroy($id_academicos){
        $academicos = Academicos::find($id_academicos);
        $academicos->delete();
        return true;
    }
    public function show($id_academicos){
        $academicos = Academicos::find($id_academicos);
        return view('academicos.show', compact('academicos'));
    }
    public function index(){
        $academicos = Academicos::all();
        return view('academicos.index', compact('academicos'));
    }
    public function getByUsuarioId($usuario_id){
        return Academicos::where('id_usuario', $usuario_id)->first();
    }
}