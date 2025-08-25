<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evento;
use Illuminate\Support\Facades\Auth;

class EventoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show', 'eventosUsuario', 'store']);
    }

    // Formulário de criação
    public function create()
    {
        $nomeArquivo = "createEvento";
        return view('eventos.create', compact('nomeArquivo'));
    }

    // Criar evento
    public function store(Request $request, $id_usuario)
    {
        $request->validate([
            'nome_evento'        => 'required|string|max:255',
            'descricao'          => 'nullable|string',
            'data_inicio_evento' => 'required|date',
            'data_final_evento'  => 'nullable|date|after_or_equal:data_inicio_evento',
            'imagem_evento.*'    => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
            'categoria_evento'   => 'nullable|string|max:100',
            'id_lugares'         => 'required|integer|exists:lugares,id_lugar',
            'id_logradouro'      => 'required|integer|exists:logradouro,id_logradouro',
            'id_atividade'       => 'required|integer|exists:atividade,id_atividade',
        ]);

        $evento = new Evento();
        $evento->nome_evento        = $request->nome_evento;
        $evento->descricao          = $request->descricao;
        $evento->data_inicio_evento = $request->data_inicio_evento;
        $evento->data_final_evento  = $request->data_final_evento;
        $evento->categoria_evento   = $request->categoria_evento;
        $evento->id_usuario         = $id_usuario;
        $evento->id_atividade       = $request->id_atividade;
        $evento->id_lugares         = $request->id_lugares;
        $evento->id_logradouro      = $request->id_logradouro;

        if ($request->hasFile('imagem_evento')) {
            $paths = [];
            foreach ($request->file('imagem_evento') as $img) {
                $paths[] = $img->store('eventos', 'public');
            }
            // se aceitar várias, salva como JSON
            $evento->imagem_evento = json_encode($paths);
        }

        $evento->save();

        return response()->json([
            'success'   => true,
            'id_evento' => $evento->id_evento,
            'message'   => 'Evento criado com sucesso!',
        ]);
    }

    // Editar
    public function edit($id_evento)
    {
        $evento = Evento::findOrFail($id_evento);
        return view('eventos.edit', compact('evento'));
    }

    // Atualizar
    public function update(Request $request, $id_evento)
    {
        $request->validate([
            'nome_evento'        => 'required|string|max:255',
            'descricao'          => 'nullable|string',
            'data_inicio_evento' => 'required|date',
            'data_final_evento'  => 'nullable|date|after_or_equal:data_inicio_evento',
            'imagem_evento'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'categoria_evento'   => 'nullable|string|max:100',
            'id_lugares'         => 'nullable|integer|exists:lugares,id',
            'id_logradouro'      => 'nullable|integer|exists:logradouros,id',
        ]);

        $evento = Evento::findOrFail($id_evento);
        $evento->nome_evento        = $request->nome_evento;
        $evento->descricao          = $request->descricao;
        $evento->data_inicio_evento = $request->data_inicio_evento;
        $evento->data_final_evento  = $request->data_final_evento;
        $evento->categoria_evento   = $request->categoria_evento;
        $evento->id_lugares         = $request->id_lugares;
        $evento->id_logradouro      = $request->id_logradouro;

        if ($request->hasFile('imagem_evento')) {
            $evento->imagem_evento = $request->file('imagem_evento')->store('eventos', 'public');
        }

        $evento->save();

        return response()->json([
            'success'   => true,
            'id_evento' => $evento->id_evento,
            'message'   => 'Evento atualizado com sucesso!'
        ]);
    }

    // Excluir
    public function destroy($id_evento)
    {
        $evento = Evento::findOrFail($id_evento);
        $evento->delete();

        return response()->json([
            'success' => true,
            'message' => 'Evento excluído com sucesso!'
        ]);
    }

    // Mostrar 1 evento
    public function show($id_evento)
    {
        $evento = Evento::findOrFail($id_evento);
        return view('eventos.show', compact('evento'));
    }

    // Listar todos
    public function index()
    {
        $eventos = Evento::all();
        return view('eventos.index', compact('eventos'));
    }

    // Eventos do usuário logado
    public function eventosUsuario($id_usuario = null)
    {
        $id_usuario = $id_usuario ?? Auth::id();

        $eventos = Evento::where('id_usuario', $id_usuario)->get()->map(function ($evento) {
            if (!$evento || !$evento->imagem_evento) {
                return response()->json([
                    'url' => 'imagens/default-event.jpg'
                ]);
            }

            // Se for JSON, decodifica
            $path = $evento->imagem_evento;
            if (is_string($path) && str_starts_with($path, '[')) {
                $decoded = json_decode($path, true);
                $path = $decoded[0] ?? $path;
            }
            return [
                'id_evento'          => $evento->id_evento,
                'nome_evento'        => $evento->nome_evento,
                'descricao'          => $evento->descricao,
                'data_inicio_evento' => $evento->data_inicio_evento,
                'data_final_evento'  => $evento->data_final_evento,
                'categoria_evento'   => $evento->categoria_evento,
                'id_lugares'         => $evento->id_lugares,
                'id_logradouro'      => $evento->id_logradouro,
                'imagem_evento'      => $evento->imagem_evento
                    ? '/../storage/' . ltrim($path, '/')
                    : 'imagens/default-event.jpg',
            ];
        });

        return response()->json($eventos);
    }
}
