<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\Usuario; // Importa o modelo Usuario
use Illuminate\Http\Request;

class AlunoController extends Controller
{
    // Lista todos os alunos
    public function index()
    {
        $alunos = Aluno::all();
        return view('alunos.index', compact('alunos'));
    }

    // Mostra o formulário de criação
    public function create()
    {
        return view('alunos.create');
    }

    // Salva novo aluno
    public function store(Request $request)
    {
        $aluno = new Aluno;
        $aluno->ra_aluno = $request->input('ra_aluno');
        $aluno->id_usuario = $usuario->id_usuario;
        $aluno->nome_aluno = $request->input('nome_aluno');
        $aluno->save();

        return redirect()->route('usuario.perfil');
    }

    // Mostra um aluno específico
    public function show($id)
    {
        $aluno = Aluno::findOrFail($id);
        return view('alunos.show', compact('aluno'));
    }

    // Mostra o formulário de edição
    public function edit($id)
    {
        $aluno = Aluno::findOrFail($id);
        return view('alunos.edit', compact('aluno'));
    }

    // Atualiza um aluno
    public function update(Request $request, $id)
    {
        $aluno = Aluno::findOrFail($id);
        $aluno = new Aluno;
        $aluno->ra_aluno = $request->input('ra_aluno');
        $aluno->id_usuario = $usuario->id_usuario;
        $aluno->nome_aluno = $request->input('nome_aluno');
        $aluno->save();

        return redirect()->route('usuario.perfil');
    }

    // Remove um aluno
    public function destroy($id)
    {
        $aluno = Aluno::findOrFail($id);
        $aluno->delete();
        return redirect()->route('usuario.tipo');
    }
}