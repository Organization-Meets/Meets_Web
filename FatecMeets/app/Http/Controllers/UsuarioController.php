<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario; // Importa o modelo Usuario

class UsuarioController extends Controller
{
    // Lista todos os usuario
    public function index()
    {
        $usuarios = Usuario::all();
        return view('usuarios.index', compact('usuarios'));
    }

    // Mostra o formulário de criação
    public function create()
    {
        return view('usuarios.create');
    }

    // Salva novo usuario
    public function store(Request $request)
    {
        $usuario = new Usuario;
        $usuario->imagem_usuario=$request->input('imagem_usuario');
        $usuario->email = $request->input('email');
        $usuario->senha = $request->input('senha');
        $usuario->status_conta = 1;
        $usuario->id_endereco = $request->input('id_endereco'); // Supondo que o ID do endereço seja enviado no request
        $usuario->save();

        return redirect()->route('usuario.perfil');
    }

    // Mostra um usuario específico
    public function show($id)
    {
        $usuario = Usuario::findOrFail($id);
        return view('usuarios.show', compact('usuario'));
    }

    // Mostra o formulário de edição
    public function edit($id)
    {
        $usuario = Usuario::findOrFail($id);
        return view('usuarios.edit', compact('usuario'));
    }

    // Atualiza um usuario
    public function update(Request $request, $id)
    {
        $usuario = new Usuario;
        $usuario->imagem_usuario=$request->input('imagem_usuario');
        $usuario->email = $request->input('email');
        $usuario->senha = $request->input('senha');
        $usuario->status_conta = 1;
        $usuario->id_endereco = $request->input('id_endereco') ?? 0; // Supondo que o ID do endereço seja enviado no request
        $usuario->save();

        return redirect()->route('usuario.perfil');
    }

    // Remove um aluno
    public function destroy($id)
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->delete();
        return redirect()->route('usuarios.tipo');
    }

    public function perfil(){
        $usuario = Usuario::find(session('usuario_id'));
        return view('usuarios.perfil', compact('usuario'));
    }

    public function logout(){
        session()->forget('usuario_id');
        return redirect()->route('login');
    }

    public function loginForm(){
        return view('usuarios.login');
    }

    // Login
    public function login(Request $request)
    {
        $email = $request->input('email');
        $senha = $request->input('senha');

        $usuario = Usuario::where('email', $email)->where('senha', $senha)->first();

        if ($usuario) {
            // Autenticação simples, pode ser melhorada com hash de senha
            // Exemplo: salvar usuário na sessão
            session(['usuario_id' => $usuario->id]);
            return redirect()->route('usuario.perfil');
        } else {
            return redirect()->back()->withErrors(['login' => 'Email ou senha inválidos']);
        }
    }
}
