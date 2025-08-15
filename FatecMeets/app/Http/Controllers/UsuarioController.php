<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario; // Importa o modelo Usuario
use App\Models\Endereco; // Importa o modelo Endereco
use App\Http\Controllers\EnderecoController; // Importa o controlador EnderecoController
use Illuminate\Support\Facades\Hash; // Importa o Hash para senhas
use App\Http\Controllers\EventoController; // Importa o controlador EventoController
use App\Models\Evento; // Importa o modelo Evento
use App\Http\Controllers\UsuarioController; 

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

    public function tipo()
    {
        return view('usuarios.tipo');
    }

    // Salva novo usuario
    public function store(Request $request)
    {
        // Cria o endereço primeiro
        $endereco = new Endereco;
        $endereco->cep = $request->input('cep');
        $endereco->numero = $request->input('numero');
        $endereco->save();

        // Garante que o id_endereco está preenchido após o save
        $usuario = new Usuario;
        $usuario->imagem_usuario = $request->input('imagem_usuario');
        $usuario->email = $request->input('email');
        $usuario->senha = Hash::make($request->input('senha'));
        $usuario->status_conta = 1;
        $usuario->id_endereco = $endereco->id_endereco; // deve funcionar se o modelo estiver correto
        $usuario->save();

        // Use redirect('/usuarios/perfil') para garantir o redirecionamento por URL
        $perfil = $this->perfil();
        return $perfil;
    }

    // Mostra um usuario específico
    public function show($id_usuario)
    {
        $usuario = Usuario::findOrFail($id_usuario);
        return view('usuarios.show', compact('usuario'));
    }

    // Mostra o formulário de edição
    public function edit($id_usuario)
    {
        $usuario = Usuario::findOrFail($id_usuario);
        return view('usuarios.edit', compact('usuario'));
    }

    // Atualiza um usuario
    public function update(Request $request, $id_usuario)
    {
        $usuario = new Usuario;
        $usuario->imagem_usuario=$request->input('imagem_usuario');
        $usuario->email = $request->input('email');
        $usuario->senha = Hash::make($request->input('senha'));
        $usuario->status_conta = 1;
        $usuario->id_endereco = $request->input('id_endereco') ?? 0; // Supondo que o ID do endereço seja enviado no request
        $usuario->save();
        $perfil = $this->perfil();
        return $perfil;
    }

    // Remove um aluno
    public function destroy($id_usuario)
    {
        $usuario = Usuario::findOrFail($id_usuario);
        $usuario->delete();
        $tipo = $this->tipo();
        return $tipo;
    }

    public function perfil(){
        $usuarioId = session('usuario_id');
        if (!$usuarioId) {
            $loginForm = $this->loginForm();
            return $loginForm;
        }
        $usuario = Usuario::find($usuarioId);
        if (!$usuario) {
            $loginForm = $this->loginForm();
            return $loginForm;
        }
        return view('usuarios.perfil', compact('usuario'));
    }

    public function logout(){
        session()->forget('usuario_id');
        $loginForm = $this->loginForm();
        return $loginForm;
    }

    public function loginForm(){
        return view('usuarios.login');
    }

    // Login
    public function login(Request $request)
    {
        $email = $request->input('email');
        $senha = $request->input('senha');

        $usuario = Usuario::where('email', $email)->first();

        if ($usuario && \Hash::check($senha, $usuario->senha)) {
            session(['usuario_id' => $usuario->id_usuario]);
            $perfil = $this->perfil();
            return $perfil;
        } else {
            return redirect()->back()->withErrors(['login' => 'Email ou senha inválidos']);
        }
    }
    public function eventos() {
        return $this->hasMany(Evento::class, 'id_usuario', 'id_usuario');
    }
}