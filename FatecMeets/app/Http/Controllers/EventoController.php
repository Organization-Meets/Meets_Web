<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evento;
use Illuminate\Support\Facades\Auth;

class EventoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function create() {
        return view('evento.create');
    }

    public function store(Request $request) {
        $request->validate([
            'nome_evento' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'data_inicio_evento' => 'required|date',
            'data_final_evento' => 'nullable|date|after_or_equal:data_inicio_evento',
            'imagem_evento' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'categoria_evento' => 'nullable|string|max:100'
        ]);

        $evento = new Evento();
        $evento->nome_evento = $request->input('nome_evento');
        $evento->descricao = $request->input('descricao');
        $evento->data_inicio_evento = $request->input('data_inicio_evento');
        $evento->data_final_evento = $request->input('data_final_evento');
        $evento->categoria_evento = $request->input('categoria_evento');
        $evento->id_usuario = Auth::id();

        if ($request->hasFile('imagem_evento')) {
            $evento->imagem_evento = $request->file('imagem_evento')->store('eventos', 'public');
        }

        $evento->save();

        return response()->json([
            'success' => true,
            'evento_id' => $evento->id_evento,
            'nome_evento' => $evento->nome_evento
        ]);
    }

    public function edit($id_evento) {
        $evento = Evento::findOrFail($id_evento);
        return view('evento.edit', compact('evento'));
    }

    public function update(Request $request, $id_evento) {
        $evento = Evento::findOrFail($id_evento);

        $request->validate([
            'nome_evento' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'data_inicio_evento' => 'required|date',
            'data_final_evento' => 'nullable|date|after_or_equal:data_inicio_evento',
            'imagem_evento' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'categoria_evento' => 'nullable|string|max:100'
        ]);

        $evento->nome_evento = $request->input('nome_evento');
        $evento->descricao = $request->input('descricao');
        $evento->data_inicio_evento = $request->input('data_inicio_evento');
        $evento->data_final_evento = $request->input('data_final_evento');
        $evento->categoria_evento = $request->input('categoria_evento');

        if ($request->hasFile('imagem_evento')) {
            $evento->imagem_evento = $request->file('imagem_evento')->store('eventos', 'public');
        }

        $evento->save();

        return response()->json(['success' => true, 'evento_id' => $evento->id_evento]);
    }

    public function destroy($id_evento) {
        $evento = Evento::findOrFail($id_evento);
        $evento->delete();

        return response()->json(['success' => true]);
    }

    public function show($id_evento) {
        $evento = Evento::findOrFail($id_evento);
        return view('evento.show', compact('evento'));
    }

    public function index() {
        $eventos = Evento::all();
        return view('evento.index', compact('eventos'));
    }

    // ✅ Rota para buscar eventos do usuário logado (ou por ID)
    public function eventosUsuario() {
        $usuario = Auth::user();
        $eventos = Evento::where('id_usuario', $usuario->id_usuario)->get();
        return response()->json($eventos);
    }
}
