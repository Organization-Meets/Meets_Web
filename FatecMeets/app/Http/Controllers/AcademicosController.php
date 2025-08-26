<?php

namespace App\Http\Controllers;

use App\Models\Academicos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AcademicosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show', 'getByUsuarioId', 'store']);
    }

    // Formulário de criação
    public function create()
    {
        $nomeArquivo = "createAcademicos";
        return view('academicos.create', compact('nomeArquivo'));
    }

    // Armazenar novo acadêmico
    public function store(Request $request, $usuario_id)
    {
        $request->validate([
            'nome_academicos' => 'required|string|max:255',
            'ra_academicos'   => 'required|integer',
        ]);

        $academicos = Academicos::create([
            'id_usuario'      => $usuario_id,
            'nome_academicos' => $request->input('nome_academicos'),
            'ra_academicos'   => $request->input('ra_academicos'),
        ]);

        return response()->json([
            'success'         => true,
            'id_academicos'   => $academicos->id_academicos,
            'nome_academicos' => $academicos->nome_academicos,
            'ra_academicos'   => $academicos->ra_academicos,
        ]);
    }

    // Editar acadêmico
    public function edit($id_academicos)
    {
        $academicos = Academicos::findOrFail($id_academicos);
        return view('academicos.edit', compact('academicos'));
    }

    // Atualizar acadêmico
    public function update(Request $request, $id_academicos)
    {
        $request->validate([
            'nome_academicos' => 'required|string|max:255',
            'ra_academicos'   => 'required|integer',
        ]);

        $academicos = Academicos::findOrFail($id_academicos);
        $academicos->nome_academicos = $request->input('nome_academicos');
        $academicos->ra_academicos   = $request->input('ra_academicos');
        $academicos->save();

        return response()->json([
            'success'       => true,
            'id_academicos' => $academicos->id_academicos,
        ]);
    }

    // Excluir acadêmico
    public function destroy($id_academicos)
    {
        $academicos = Academicos::findOrFail($id_academicos);
        $academicos->delete();

        return response()->json([
            'success' => true,
            'message' => 'Registro acadêmico excluído com sucesso!',
        ]);
    }

    // Mostrar detalhes de um acadêmico
    public function show($id_academicos)
    {
        $academicos = Academicos::findOrFail($id_academicos);
        return view('academicos.show', compact('academicos'));
    }

    // Listar todos os acadêmicos
    public function index()
    {
        $academicos = Academicos::all();
        return view('academicos.index', compact('academicos'));
    }

    // Buscar acadêmicos pelo ID do usuário (logado ou passado)
    public function getByUsuarioId($usuario_id = null)
    {
        $usuario_id = $usuario_id ?? Auth::id();
        $academicos = Academicos::where('id_usuario', $usuario_id)->first();

        if (!$academicos) {
            return response()->json([
                'success' => false,
                'message' => 'Nenhum registro acadêmico encontrado.'
            ], 404);
        }

        return response()->json([
            'success'    => true,
            'academicos' => $academicos,
        ]);
    }
}
