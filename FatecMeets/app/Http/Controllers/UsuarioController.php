<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UsuarioController extends Controller
{
    public function create(){
        $nomeArquivo = "createUsuario";
        return view('usuario.create', compact('nomeArquivo'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:usuario,email',
            'senha' => 'required|min:6|confirmed',
            'imagem_usuario' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'tipo_usuario' => 'required|in:aluno,professor'
        ]);

        $usuario = new Usuario();
        
        // email fornecido
        $usuario->email = $request->input('email');
        $usuario->senha = Hash::make($request->input('senha'));
        $usuario->status_conta = 'ativo';

        // upload imagem
        if ($request->hasFile('imagem_usuario')) {
            $path = $request->file('imagem_usuario')->store('usuarios', 'public');
            $usuario->imagem_usuario = $path;
        }

        $usuario->save();

        // Extrair nome do email para exibir como "Gabriel Rodrigues"
        // Exemplo: email = gabriel.rodrigues106@fatec.sp.gov.br
        $emailUser = explode('@', $usuario->email)[0]; // "gabriel.rodrigues106"
        $parts = explode('.', $emailUser); // ["gabriel", "rodrigues106"]
        $firstName = ucfirst($parts[0]);
        $lastName = isset($parts[1]) ? ucfirst(preg_replace('/\d+$/', '', $parts[1])) : '';
        $nomeCompleto = trim($firstName . ' ' . $lastName);

        $nickname = '@' . $emailUser;

        return response()->json([
            'usuario_id' => $usuario->id_usuario,
            'nome' => $nomeCompleto,
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
        $nomeArquivo = "login";
        return view('usuario.login', compact('nomeArquivo'));
    }

    public function login(Request $request){
        $credentials = $request->only('email', 'senha');
        $usuario = Usuario::where('email', $credentials['email'])->first();
        if ($usuario && Hash::check($credentials['senha'], $usuario->senha)) {
            Auth::login($usuario);
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false], 401);
    }

    public function logout(){
        Auth::logout();
        return true;
    }

    public function perfil(){
        $usuario = Auth::user();
        $nomeArquivo = "perfilUsuario";
        return view('usuario.perfil', compact('usuario', 'nomeArquivo'));
    }
    public function home(){
        $usuario = Auth::user();
        $nomeArquivo = "homeUsuario";
        return view('usuario.home', compact('usuario', 'nomeArquivo'));
    }
}