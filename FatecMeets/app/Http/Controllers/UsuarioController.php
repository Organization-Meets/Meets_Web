<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UsuarioController extends Controller
{
    public function __construct()
    {
        // Apenas usuários autenticados podem criar, atualizar ou deletar
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index()
    {
        return response()->json(Usuario::all());
    }

    public function show($id)
    {
        return response()->json(Usuario::findOrFail($id));
    }

    public function store(Request $request)
    {
        // ✅ Validação dos dados
        $request->validate([
            'email' => 'required|email|unique:usuarios,email',
            'password' => 'required|min:6',
        ]);

        $token = Str::random(6);

        $usuario = Usuario::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'email_verification_token' => $token,
            'status' => 'inativo',
        ]);

        Mail::raw("Seu código de verificação é: {$token}", function ($message) use ($usuario) {
            $message->to($usuario->email)
                    ->subject('Confirmação de E-mail - Fatec Meets');
        });

        return response()->json([
            'success' => true,
            'message' => 'Usuário criado! Verifique seu e-mail para confirmar a conta.'
        ]);
    }
    public function verifyEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'token' => 'required|string',
        ]);

        $usuario = Usuario::where('email', $request->email)
            ->where('email_verification_token', $request->token)
            ->first();

        if (!$usuario) {
            return response()->json([
                'success' => false,
                'message' => 'Token inválido ou expirado.'
            ], 400);
        }

        // Marca o e-mail como verificado
        $usuario->update([
            'email_verified_at' => now(),
            'email_verification_token' => null,
            'status' => 'ativo',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'E-mail confirmado com sucesso!'
        ]);
    }

    public function update(Request $request, $id)
    {
        $obj = Usuario::findOrFail($id);
        $obj->update($request->all());
        return response()->json($obj);
    }

    public function destroy($id)
    {
        Usuario::destroy($id);
        return response()->json(null, 204);
    }
}
