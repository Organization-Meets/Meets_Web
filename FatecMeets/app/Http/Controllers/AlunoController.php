<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use Illuminate\Http\Request;

class AlunoController extends Controller
{
    public function create(){
        return view('aluno.create');
    }

    public function store(Request $request, $usuario_id){
        $aluno = new Aluno();
        $aluno->id_usuario = $usuario_id;
        $aluno->nome_aluno = $request->input('nome_aluno');
        $aluno->ra_aluno = $request->input('ra_aluno');
        $aluno->save();
    }

    public function edit($id_aluno){
        $aluno = Aluno::find($id_aluno);
        return view('aluno.edit', compact('aluno'));
    }

    public function update(Request $request, $id_aluno){
        $aluno = Aluno::find($id_aluno);
        $aluno->nome_aluno = $request->input('nome_aluno');
        $aluno->ra_aluno = $request->input('ra_aluno');
        $aluno->save();
        return true;
    }

    public function destroy($id_aluno){
        $aluno = Aluno::find($id_aluno);
        $aluno->delete();
        return true;
    }

    public function show($id_aluno){
        $aluno = Aluno::find($id_aluno);
        return view('aluno.show', compact('aluno'));
    }

    public function index(){
        $alunos = Aluno::all();
        return view('aluno.index', compact('alunos'));
    }

    public function getByUsuarioId($usuario_id){
        return Aluno::where('id_usuario', $usuario_id)->get();
    }
}