<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agenda;

class AgendaController extends Controller
{
    public function create(){
        return view('agenda.create');
    }

    public function store(Request $request, $usuario_id){
        $agenda = new Agenda();
        $agenda->id_usuario = $usuario_id;
        $agenda->data_agenda = $request->input('data_agenda');
        $agenda->descricao = $request->input('descricao');
        $agenda->id_evento = $request->input('id_evento');
        $agenda->save();
    }

    public function edit($id_agenda){
        $agenda = Agenda::find($id_agenda);
        return view('agenda.edit', compact('agenda'));
    }

    public function update(Request $request, $id_agenda){
        $agenda = Agenda::find($id_agenda);
        $agenda->id_usuario = $request->input('id_usuario');
        $agenda->data_agenda = $request->input('data_agenda');
        $agenda->descricao = $request->input('descricao');
        $agenda->id_evento = $request->input('id_evento');
        $agenda->save();
        return true;
    }

    public function destroy($id_agenda){
        $agenda = Agenda::find($id_agenda);
        $agenda->delete();
        return true;
    }

    public function show($id_agenda){
        $agenda = Agenda::find($id_agenda);
        return view('agenda.show', compact('agenda'));
    }

    public function index(){
        $agendas = Agenda::all();
        return view('agenda.index', compact('agendas'));
    }

    public function getByUsuarioId($usuario_id){
        return Agenda::where('id_usuario', $usuario_id)->get();
    }
}
