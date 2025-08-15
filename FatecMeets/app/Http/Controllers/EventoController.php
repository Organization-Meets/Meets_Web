<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evento;
use App\Models\Endereco;

class EventoController extends Controller
{
    // Lista todos os eventos
    public function index()
    {
        $eventos = Evento::all();
        return view('eventos.index', compact('eventos'));
    }

    // Mostra o formulário de criação de evento
    public function create()
    {
        return view('eventos.create');
    }

    // Salva novo evento
    public function store(Request $request)
    {
        // Validação básica
        $request->validate([
            'nome_evento' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'data_inicio_evento' => 'required|date',
            'data_final_evento' => 'nullable|date',
            'id_usuario' => 'required|integer|exists:usuario,id_usuario',
            'imagem_evento' => 'nullable|string|max:255',
            'id_endereco' => 'nullable|integer|exists:endereco,id_endereco',
        ]);

        $evento = Evento::create($request->all());

        return redirect()->route('eventos.index')->with('success', 'Evento criado com sucesso!');
    }

    // Mostra um evento específico
    public function show($id_evento)
    {
        $evento = Evento::findOrFail($id_evento);
        return view('eventos.show', compact('evento'));
    }

    // Mostra o formulário de edição
    public function edit($id_evento)
    {
        $evento = Evento::findOrFail($id_evento);
        return view('eventos.edit', compact('evento'));
    }

    // Atualiza um evento
    public function update(Request $request, $id_evento)
    {
        $evento = Evento::findOrFail($id_evento);

        $request->validate([
            'nome_evento' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'data_inicio_evento' => 'required|date',
            'data_final_evento' => 'nullable|date',
            'imagem_evento' => 'nullable|string|max:255',
            'id_endereco' => 'nullable|integer|exists:endereco,id_endereco',
        ]);

        $evento->update($request->all());

        return redirect()->route('eventos.show', $evento->id_evento)->with('success', 'Evento atualizado com sucesso!');
    }

    // Remove um evento
    public function destroy($id_evento)
    {
        $evento = Evento::findOrFail($id_evento);
        $evento->delete();
        return redirect()->route('eventos.index')->with('success', 'Evento removido com sucesso!');
    }
    public function showUsuario($id_usuario)
    {
        $eventos = Evento::where('id_usuario', $id_usuario)->get();
        return view('eventos.usuario', compact('eventos'));
    }
}
