<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario; // Importa o modelo Usuario
use App\Models\Endereco; // Importa o modelo Endereco
use App\Models\Evento; // Importa o modelo Evento 
use App\Models\Aluno; // Importa o modelo Aluno
use App\Models\Academicos; // Importa o modelo Academicos
use App\Models\Telefone; // Importa o modelo Telefone
use App\Models\Gameficacao; // Importa o modelo Gameficacao
use App\Http\Controllers\AdministradoresController; 
use App\Http\Controllers\GameficacaoController; // Importa o controlador GameficacaoController
use App\Http\Controllers\TelefoneController; // Importa o controlador TelefoneController
use App\Http\Controllers\AlunoController; // Importa o controlador AlunoController
use App\Http\Controllers\AcademicosController; // Importa o controlador AcademicosController
use App\Http\Controllers\EnderecoController; // Importa o controlador EnderecoController
use App\Http\Controllers\EventoController; // Importa o controlador EventoController
use Illuminate\Support\Facades\Hash; // Importa o Hash para senhas

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
    public function adicionais(Request $request)
    {
        $tipo = $request->input('tipo_usuario');

        if ($tipo == 'aluno') {
            $alunoController = new AlunoController();
            $aluno = $alunoController->store($request);
        } elseif ($tipo == 'academicos') {
            $academicosController = new AcademicosController();
            $academicos = $academicosController->store($request);
        } else {
            echo "Tipo de usuário inválido.";
        }

        // Cria o endereço primeiro
        $gameficacaoController = new GameficacaoController();
        $gameficacao = $gameficacaoController->store($request);
        $gameficacao->save();


        $perfil = $this->perfil();
        return $perfil;
    }
    public function adicionaisForm($tipo, $nome, $nickname)
    {
        return view('usuarios.adicionais', compact('tipo', 'nome', 'nickname'));
    }

    public function store(Request $request)
    {
        $usuario = new Usuario;
        $usuario->imagem_usuario = $request->input('imagem_usuario');
        $usuario->email = $request->input('email');
        $usuario->senha = Hash::make($request->input('senha'));
        $usuario->status_conta = 1;
        $emailUser = explode('@', $usuario->email)[0];
        $nickname = '@' . $emailUser;
        // Nome: separa por ponto, remove dígitos de cada parte, capitaliza e junta
        $nomeParts = explode('.', $emailUser);
        $nome = array_map(function($part) {
            return ucfirst(preg_replace('/\d+/', '', $part));
        }, $nomeParts);
        $nome = implode(' ', array_filter($nome, fn($part) => strlen($part) > 0));

        $usuario->save();

        $tipo = $request->input('tipo_usuario');
        session(['usuario_id' => $usuario->id_usuario]);
        $adicionaisForm = $this->adicionaisForm($tipo, $nome, $nickname);
        return $adicionaisForm;
    }
    public function uploadImagem()
    {

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
            $administradores = new AdministradoresController();
            $admin = $administradores->isAdmin($usuario->id_usuario);
            if($admin){
                session(['usuario_nome' => $usuario->email]);
                return redirect()->route('admin.dashboard');
            }
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