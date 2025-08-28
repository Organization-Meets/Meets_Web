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
        // Validação
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:usuarios,email',
            'password' => 'required|string|min:6',
        ]);

        // Criação do usuário
        $usuario = Usuario::create([
            'nome' => $validated['nome'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'token_verificacao' => Str::random(60), // gera token único
        ]);

        return response()->json([
            'message' => 'Usuário criado. Token gerado, mas o e-mail não foi enviado automaticamente.',
            'usuario' => $usuario,
        ], 201);
    }

    /**
     * Envia token de verificação por e-mail (chamado separadamente)
     */
    public function enviarToken($id)
    {
        $usuario = Usuario::findOrFail($id);

        if (!$usuario->token_verificacao) {
            $usuario->token_verificacao = Str::random(60);
            $usuario->save();
        }

        Mail::send('emails.verificacao', ['token' => $usuario->token_verificacao], function ($message) use ($usuario) {
            $message->to($usuario->email);
            $message->subject('Confirme sua conta');
        });

        return response()->json(['message' => 'Token enviado por e-mail.']);
    }

    /**
     * Verifica token recebido
     */
    public function verifyToken($token)
    {
        $usuario = Usuario::where('token_verificacao', $token)->first();

        if (!$usuario) {
            return response()->json(['message' => 'Token inválido'], 400);
        }

        $usuario->email_verified_at = now();
        $usuario->token_verificacao = null;
        $usuario->save();

        return response()->json(['message' => 'Conta verificada com sucesso!']);
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
