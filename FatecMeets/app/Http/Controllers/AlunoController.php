<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
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
        $aluno = Aluno::create($request->all());
        return redirect()->route('alunos.index');
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
        $aluno->update($request->all());
        return redirect()->route('alunos.index');
    }

    // Remove um aluno
    public function destroy($id)
    {
        $aluno = Aluno::findOrFail($id);
        $aluno->delete();
        return redirect()->route('alunos.index');
    }
}