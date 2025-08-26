<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Administradores;
use Illuminate\Support\Facades\Auth;

class AdministradoresController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show', 'getByUsuarioId', 'store']);
    }

    // Formulário de criação
    public function create()
    {
        $nomeArquivo = "createAdministrador";
        return view('administradores.create', compact('nomeArquivo'));
    }

    // Criar novo administrador
    public function store(Request $request, $usuario_id)
    {
        $request->validate([
            'nome_administrador' => 'required|string|max:255',
        ]);

        $administrador = Administradores::create([
            'id_usuario'         => $usuario_id,
            'nome_administrador' => $request->input('nome_administrador'),
        ]);

        return response()->json([
            'success'            => true,
            'id_administrador'   => $administrador->id_administrador,
            'nome_administrador' => $administrador->nome_administrador,
        ]);
    }

    // Editar administrador
    public function edit($id_administrador)
    {
        $administrador = Administradores::findOrFail($id_administrador);
        return view('administradores.edit', compact('administrador'));
    }

    // Atualizar administrador
    public function update(Request $request, $id_administrador)
    {
        $request->validate([
            'nome_administrador' => 'required|string|max:255',
        ]);

        $administrador = Administradores::findOrFail($id_administrador);
        $administrador->nome_administrador = $request->input('nome_administrador');
        $administrador->save();

        return response()->json([
            'success'          => true,
            'id_administrador' => $administrador->id_administrador,
        ]);
    }

    // Excluir administrador
    public function destroy($id_administrador)
    {
        $administrador = Administradores::findOrFail($id_administrador);
        $administrador->delete();

        return response()->json([
            'success' => true,
            'message' => 'Administrador excluído com sucesso!',
        ]);
    }

    // Mostrar detalhes de administrador
    public function show($id_administrador)
    {
        $administrador = Administradores::findOrFail($id_administrador);
        return view('administradores.show', compact('administrador'));
    }

    // Listar todos administradores
    public function index()
    {
        $administradores = Administradores::all();
        return view('administradores.index', compact('administradores'));
    }

    // Buscar administrador pelo usuário
    public function getByUsuarioId($usuario_id = null)
    {
        $usuario_id = $usuario_id ?? Auth::id();
        $administrador = Administradores::where('id_usuario', $usuario_id)->first();

        if (!$administrador) {
            return response()->json([
                'success' => false,
                'message' => 'Nenhum administrador encontrado.'
            ], 404);
        }

        return response()->json([
            'success'       => true,
            'administrador' => $administrador,
        ]);
    }
}
