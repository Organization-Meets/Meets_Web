<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlunoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show', 'getByUsuarioId', 'store']);
    }

    // Formulário de criação (opcional)
    public function create()
    {
        $nomeArquivo = "createAluno";
        return view('aluno.create', compact('nomeArquivo'));
    }

    // Armazenar novo aluno
    public function store(Request $request, $id_usuario)
    {
        $request->validate([
            'nome_aluno' => 'required|string|max:255',
            'ra_aluno' => 'required|integer',
        ]);

        $aluno = Aluno::create([
            'nome_aluno' => $request->input('nome_aluno'),
            'ra_aluno' => $request->input('ra_aluno'),
            'id_usuario' => $id_usuario,
        ]);

        return response()->json([
            'success' => true,
            'id_aluno' => $aluno->id_aluno,
            'nome_aluno' => $aluno->nome_aluno,
            'ra_aluno' => $aluno->ra_aluno
        ]);
    }

    // Editar aluno
    public function edit($id_aluno)
    {
        $aluno = Aluno::findOrFail($id_aluno);
        return view('aluno.edit', compact('aluno'));
    }

    // Atualizar aluno
    public function update(Request $request, $id_aluno)
    {
        $request->validate([
            'nome_aluno' => 'required|string|max:255',
            'ra_aluno' => 'required|integer',
        ]);

        $aluno = Aluno::findOrFail($id_aluno);
        $aluno->nome_aluno = $request->input('nome_aluno');
        $aluno->ra_aluno = $request->input('ra_aluno');
        $aluno->save();

        return response()->json([
            'success' => true,
            'id_aluno' => $aluno->id_aluno
        ]);
    }

    // Excluir aluno
    public function destroy($id_aluno)
    {
        $aluno = Aluno::findOrFail($id_aluno);
        $aluno->delete();

        return response()->json([
            'success' => true,
            'message' => 'Aluno excluído com sucesso!'
        ]);
    }

    // Mostrar detalhes de um aluno
    public function show($id_aluno)
    {
        $aluno = Aluno::findOrFail($id_aluno);
        return view('aluno.show', compact('aluno'));
    }

    // Listar todos os alunos
    public function index()
    {
        $alunos = Aluno::all();
        return view('aluno.index', compact('alunos'));
    }

    // Buscar alunos pelo ID do usuário logado
    public function getByUsuarioId($id_usuario = null)
    {
        $id_usuario = $id_usuario ?? Auth::id();
        $aluno = Aluno::where('id_usuario', $id_usuario)->first();

        return response()->json($aluno);
    }
}
