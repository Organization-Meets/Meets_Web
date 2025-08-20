<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UsuarioController extends Controller
{
    public function create(){
        return view('usuario.create');
    }

    public function store(Request $request)
    {
        // Validação básica
        $request->validate([
            'email' => 'required|email|unique:usuarios,email',
            'senha' => 'required|min:6|confirmed', // se usar "senha" + "confirmar_senha"
            'imagem_usuario' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'tipo_usuario' => 'required|in:aluno,professor'
        ]);

        $usuario = new Usuario();
        $usuario->email = $request->input('email');
        $usuario->senha = Hash::make($request->input('senha'));
        $usuario->status_conta = 'ativo';

        // Upload da imagem
        if ($request->hasFile('imagem_usuario')) {
            $path = $request->file('imagem_usuario')->store('usuarios', 'public');
            $usuario->imagem_usuario = $path;
        }

        $usuario->save();

        // Aqui você pode gerar um nome padrão e nickname,
        // ou pode deixar para vir do form da parte 2
        $nome = explode('@', $usuario->email)[0]; // Exemplo simples
        $nickname = $nome . rand(100, 999);

        // Retorna o JSON que o front espera
        return response()->json([
            'usuario_id' => $usuario->id,
            'nome' => ucfirst($nome),
            'nickname' => $nickname,
            'tipo_usuario' => $request->input('tipo_usuario')
        ]);
    }

    public function edit($id_usuario){
        $usuario = Usuario::find($id_usuario);
        return view('usuario.edit', compact('usuario'));
    }

    public function update(Request $request, $id_usuario){
        $usuario = Usuario::find($id_usuario);
        $usuario->email = $request->input('email');
        if ($request->filled('senha')) {
            $usuario->senha = Hash::make($request->input('senha'));
        }
        $usuario->imagem_usuario = $request->input('imagem_usuario');
        $usuario->status_conta = $request->input('status_conta', $usuario->status_conta);
        $usuario->save();
        return true;
    }

    public function destroy($id_usuario){
        $usuario = Usuario::find($id_usuario);
        $usuario->delete();
        return true;
    }

    public function show($id_usuario){
        $usuario = Usuario::find($id_usuario);
        return view('usuario.show', compact('usuario'));
    }

    public function index(){
        $usuarios = Usuario::all();
        return view('usuario.index', compact('usuarios'));
    }

    public function loginForm(){
        return view('usuario.login');
    }

    public function login(Request $request){
        $credentials = $request->only('email', 'senha');
        $usuario = Usuario::where('email', $credentials['email'])->first();
        if ($usuario && Hash::check($credentials['senha'], $usuario->senha)) {
            Auth::login($usuario);
            return redirect()->route('usuarios.perfil');
        }
        return back()->withErrors(['email' => 'Credenciais inválidas']);
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('usuarios.loginForm');
    }

    public function perfil(){
        $usuario = Auth::user();
        return view('usuario.perfil', compact('usuario'));
    }
}