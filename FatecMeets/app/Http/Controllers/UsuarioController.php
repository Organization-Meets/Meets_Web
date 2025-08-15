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
        if (session('usuario_nome')) {
            $perfil = $this->perfil();
            return $perfil;
        }
        return view('usuarios.tipo');
    }
    public function tipoUsuario(Request $request)
    {
        $tipo = $request->input('tipo_usuario');
        $adicionaisForm = $this->adicionaisForm($tipo);
        return $adicionaisForm;
    }
    public function adicionais(Request $request)
    {
        $tipo = $request->input('tipo_usuario');

        if ($tipo == 'aluno') {
            $alunoController = new AlunoController();
            $aluno = $alunoController->store($request);
            session(['usuario_nome' => $aluno->nome_aluno]);
        } elseif ($tipo == 'professor') {
            $professorController = new ProfessorController();
            $professor = $professorController->store($request);
            session(['usuario_nome' => $professor->nome_professor]);
        } elseif ($tipo == 'admin') {
            echo "Admin";
        } else {
            echo "Tipo de usuário inválido.";
        }

        $telefoneController = new TelefoneController();
        $telefone = $telefoneController->store($request);
    

        $perfil = $this->perfil();
        return $perfil;
    }
    public function adicionaisForm($tipo)
    {
        return view('usuarios.adicionais', compact('tipo'));
    }

    // Salva novo usuario
    public function store(Request $request)
    {
        // Cria o endereço primeiro
        $enderecoController = new EnderecoController();
        $endereco = $enderecoController->store($request);
        $endereco->save();

        $usuario = new Usuario;
        $usuario->imagem_usuario = $request->input('imagem_usuario');
        $usuario->email = $request->input('email');
        $usuario->senha = Hash::make($request->input('senha'));
        $usuario->status_conta = 1;
        $usuario->id_endereco = $endereco->id_endereco;
        $usuario->save();

        session(['usuario_id' => $usuario->id_usuario]);
        $tipo = $this->tipo();
        return $tipo;
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
        $create = $this->create();
        return $create;
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
        session()->forget('usuario_nome');
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