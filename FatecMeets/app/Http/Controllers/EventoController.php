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

    public function create()
    {
        $nomeArquivo = "createEvento";
        return view('eventos.create', compact('nomeArquivo'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome_evento' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'data_inicio_evento' => 'required|date',
            'data_final_evento' => 'nullable|date|after_or_equal:data_inicio_evento',
            'imagem_evento' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
            'categoria_evento' => 'nullable|string|max:100',
            'local_evento' => 'nullable|string|max:255',
        ]);

        $evento = new Evento();
        $evento->nome_evento = $request->nome_evento;
        $evento->descricao = $request->descricao;
        $evento->data_inicio_evento = $request->data_inicio_evento;
        $evento->data_final_evento = $request->data_final_evento;
        $evento->categoria_evento = $request->categoria_evento;
        $evento->local_evento = $request->local_evento;
        $evento->id_usuario = Auth::id();

        if ($request->hasFile('imagem_evento')) {
            $evento->imagem_evento = $request->file('imagem_evento')->store('eventos', 'public');
        }

        $evento->save();

        return response()->json([
            'success' => true,
            'message' => 'Evento criado com sucesso!',
            'id_evento' => $evento->id_evento
        ]);
    }

    public function edit($id_evento)
    {
        $evento = Evento::findOrFail($id_evento);
        return view('eventos.edit', compact('evento'));
    }

    public function update(Request $request, $id_evento)
    {
        $evento = Evento::findOrFail($id_evento);

        $request->validate([
            'nome_evento' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'data_inicio_evento' => 'required|date',
            'data_final_evento' => 'nullable|date|after_or_equal:data_inicio_evento',
            'imagem_evento' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'categoria_evento' => 'nullable|string|max:100',
            'local_evento' => 'nullable|string|max:255'
        ]);

        $evento->nome_evento = $request->nome_evento;
        $evento->descricao = $request->descricao;
        $evento->data_inicio_evento = $request->data_inicio_evento;
        $evento->data_final_evento = $request->data_final_evento;
        $evento->categoria_evento = $request->categoria_evento;
        $evento->local_evento = $request->local_evento;

        if ($request->hasFile('imagem_evento')) {
            $evento->imagem_evento = $request->file('imagem_evento')->store('eventos', 'public');
        }

        $evento->save();

        return redirect()->route('eventos.edit', $evento->id_evento)->with('success', 'Evento atualizado com sucesso!');
    }

    public function destroy($id_evento)
    {
        $evento = Evento::findOrFail($id_evento);
        $evento->delete();
        return redirect()->back()->with('success', 'Evento excluído com sucesso!');
    }

    public function show($id_evento)
    {
        $evento = Evento::findOrFail($id_evento);
        return view('eventos.show', compact('evento'));
    }

    public function index()
    {
        $eventos = Evento::all();
        return view('eventos.index', compact('eventos'));
    }

    public function eventosUsuario()
    {
        $usuario = Auth::user();
        $eventos = Evento::where('id_usuario', $usuario->id_usuario)->get();

        $eventos = $eventos->map(function ($evento) {
            return [
                'id_evento' => $evento->id_evento,
                'nome_evento' => $evento->nome_evento,
                'descricao' => $evento->descricao,
                'data_inicio_evento' => $evento->data_inicio_evento,
                'data_final_evento' => $evento->data_final_evento,
                'categoria_evento' => $evento->categoria_evento,
                'local_evento' => $evento->local_evento,
                'imagem_evento' => $evento->imagem_evento
                    ? asset('storage/' . $evento->imagem_evento)
                    : asset('assets/default-event.jpg'),
            ];
        });

        return response()->json($eventos);
    }
}