<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UsuarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['create', 'store', 'loginForm', 'login', 'perfil', 'home', 'dadosUsuario', 'imagemUsuario', 'edit', 'show', 'index', 'confirmarSenha', 'update', 'destroy']);
    }
    public function create(){
        $nomeArquivo = "createUsuario";
        return view('usuario.create', compact('nomeArquivo'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:usuario,email',
            'password' => 'required|min:6|confirmed',
            'imagem_usuario.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'tipo_usuario' => 'required|in:aluno,professor'
        ]);

        $usuario = new Usuario();
        $usuario->email = $request->input('email');
        $usuario->password = Hash::make($request->input('password'));
        $usuario->status_conta = 'ativo';

        // =====================
        // Upload de imagens
        // =====================
        if ($request->hasFile('imagem_usuario')) {
            $paths = [];
            foreach ($request->file('imagem_usuario') as $file) {
                $paths[] = $file->store('usuarios', 'public');
            }
            $usuario->imagem_usuario = json_encode($paths);
        } else {
            $usuario->imagem_usuario = null;
        }

        $usuario->save();

        // Criar nome e nickname a partir do email
        $emailUser = explode('@', $usuario->email)[0];
        $parts = explode('.', $emailUser);
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

    public function update(Request $request, $id_usuario)
    {
        $usuario = Usuario::findOrFail($id_usuario);

        $usuario->email = $request->input('email');
        if ($request->filled('password')) {
            $usuario->password = Hash::make($request->input('password'));
        }
        $usuario->status_conta = $request->input('status_conta', $usuario->status_conta);

        // =====================
        // Atualizar imagens
        // =====================
        if ($request->hasFile('imagem_usuario')) {
            $paths = [];
            foreach ($request->file('imagem_usuario') as $file) {
                $paths[] = $file->store('usuarios', 'public');
            }
            $usuario->imagem_usuario = json_encode($paths);
        }

        $usuario->save();

        return response()->json(['success' => true]);
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
        $credentials = $request->only('email', 'password');
        $usuario = Usuario::where('email', $credentials['email'])->first();
        if ($usuario && Hash::check($credentials['password'], $usuario->password)) {
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
        if (!$usuario){
            return false;
        } else {
            return view('usuario.perfil', compact('usuario', 'nomeArquivo'));
        }
    }
    public function home(){
        $usuario = Auth::user();
        $nomeArquivo = "homeUsuario";
        return view('usuario.home', compact('usuario', 'nomeArquivo'));
    }
    public function dadosUsuario() {
        $usuario = Auth::user();
        if (!$usuario) return response()->json([], 404);

        return response()->json([
            'usuario_id' => $usuario->id_usuario,
            'nome' => $usuario->nome,
            'nickname' => $usuario->nickname,
            'email' => $usuario->email,
            'numero' => $usuario->numero,
        ]);
    }

    public function imagemUsuario()
    {
        $usuario = Auth::user();

        if (!$usuario || !$usuario->imagem_usuario) {
            return response()->json([
                'url' => 'uploads/imgPadrao.png'
            ]);
        }

        // Se for JSON, decodifica
        $path = $usuario->imagem_usuario;
        if (is_string($path) && str_starts_with($path, '[')) {
            $decoded = json_decode($path, true);
            $path = $decoded[0] ?? $path;
        }

        return response()->json([
            'url' => '/../storage/' . ltrim($path, '/')
        ]);
    }

    public function confirmarSenha(Request $request)
    {
        $user = Auth::user();
        if (!$user || !Hash::check($request->senha, $user->password)) {
            return response()->json(['erro' => 'Senha incorreta'], 401);
        }
        return response()->json(['ok' => true]);
    }
}