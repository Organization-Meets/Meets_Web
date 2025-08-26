<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agenda;

class AgendaController extends Controller
{
    public function create()
    {
        return view('agenda.create');
    }

    public function store(Request $request, $usuario_id)
    {
        $request->validate([
            'data_agenda' => 'required|date',
            'descricao'   => 'nullable|string|max:255',
            'id_evento'   => 'nullable|integer|exists:eventos,id_evento',
        ]);

        $agenda = new Agenda();
        $agenda->id_usuario  = $usuario_id;
        $agenda->data_agenda = $request->input('data_agenda');
        $agenda->descricao   = $request->input('descricao');
        $agenda->id_evento   = $request->input('id_evento');
        $agenda->save();

        return response()->json(['success' => true, 'agenda_id' => $agenda->id_agenda]);
    }

    public function edit($id_agenda)
    {
        $agenda = Agenda::findOrFail($id_agenda);
        return view('agenda.edit', compact('agenda'));
    }

    public function update(Request $request, $id_agenda)
    {
        $request->validate([
            'id_usuario'  => 'required|integer|exists:usuario,id_usuario',
            'data_agenda' => 'required|date',
            'descricao'   => 'nullable|string|max:255',
            'id_evento'   => 'nullable|integer|exists:eventos,id_evento',
        ]);

        $agenda = Agenda::findOrFail($id_agenda);
        $agenda->id_usuario  = $request->input('id_usuario');
        $agenda->data_agenda = $request->input('data_agenda');
        $agenda->descricao   = $request->input('descricao');
        $agenda->id_evento   = $request->input('id_evento');
        $agenda->save();

        return response()->json(['success' => true]);
    }

    public function destroy($id_agenda)
    {
        $agenda = Agenda::findOrFail($id_agenda);
        $agenda->delete();

        return response()->json(['success' => true]);
    }

    public function show($id_agenda)
    {
        $agenda = Agenda::findOrFail($id_agenda);
        return view('agenda.show', compact('agenda'));
    }

    public function index()
    {
        $agendas = Agenda::all();
        return view('agenda.index', compact('agendas'));
    }

    public function getByUsuarioId($usuario_id)
    {
        $agendas = Agenda::where('id_usuario', $usuario_id)->get();
        return response()->json($agendas);
    }
}
