<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class UsuarioController extends Controller
{
    public function __construct()
    {
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
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:usuarios,email',
            'password' => 'required|string|min:6',
        ]);

        $usuario = Usuario::create([
            'nome' => $validated['nome'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'token_verificacao' => Str::random(60),
        ]);

        return response()->json([
            'message' => 'Usuário criado. Token gerado, mas o e-mail não foi enviado automaticamente.',
            'usuario' => $usuario,
        ], 201);
    }

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

    public function verifyToken($token)
    {
        $usuario = Usuario::where('token_verificacao', $token)->first();

        if (!$usuario) {
            return response()->json(['message' => 'Token inválido'], 400);
        }

        $usuario->email_verified_at = now();
        $usuario->token_verificacao = null;
        $usuario->save();

        return response()->json(['message' => 'Token verificado com sucesso!']);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (!Auth::attempt($credentials)) {
            return response()->json(['success' => false, 'message' => 'Credenciais inválidas'], 401);
        }

        $usuario = Auth::user();

        // Verifica se o e-mail foi confirmado, se quiser bloquear login de não verificados
        if (!$usuario->email_verified_at) {
            return response()->json(['success' => false, 'message' => 'E-mail não verificado'], 403);
        }

        // Cria token pessoal com Sanctum
        $token = $usuario->createToken('token_sanctum')->plainTextToken;

        return response()->json([
            'success' => true,
            'token' => $token,
            'usuario' => $usuario,
        ]);
    }
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete(); // Revoga todos os tokens do usuário
        return response()->json(['message' => 'Logout realizado com sucesso.']);
    }
    public function logged()
    {
        return response()->json([
            'logged' => auth()->check(),
            'user'   => auth()->user()
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
