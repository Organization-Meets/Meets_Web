<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evento_denunciado;

class EventoDenunciadoController extends Controller
{
    public function create(){
        return view('evento_denunciado.create');
    }

    public function store(Request $request){
        $eventoDenunciado = new Evento_denunciado();
        $eventoDenunciado->id_evento = $request->input('id_evento');
        $eventoDenunciado->id_administrador = $request->input('id_administrador');
        $eventoDenunciado->id_lixo = $request->input('id_lixo');
        $eventoDenunciado->motivo_denuncia = $request->input('motivo_denuncia');
        $eventoDenunciado->status_denuncia = $request->input('status_denuncia', 'pendente');
        $eventoDenunciado->save();
    }

    public function edit($id_evento_denunciado){
        $eventoDenunciado = Evento_denunciado::find($id_evento_denunciado);
        return view('evento_denunciado.edit', compact('eventoDenunciado'));
    }

    public function update(Request $request, $id_evento_denunciado){
        $eventoDenunciado = Evento_denunciado::find($id_evento_denunciado);
        $eventoDenunciado->id_evento = $request->input('id_evento');
        $eventoDenunciado->id_administrador = $request->input('id_administrador');
        $eventoDenunciado->id_lixo = $request->input('id_lixo');
        $eventoDenunciado->motivo_denuncia = $request->input('motivo_denuncia');
        $eventoDenunciado->status_denuncia = $request->input('status_denuncia', $eventoDenunciado->status_denuncia);
        $eventoDenunciado->save();
        return true;
    }

    public function destroy($id_evento_denunciado){
        $eventoDenunciado = Evento_denunciado::find($id_evento_denunciado);
        $eventoDenunciado->delete();
        return true;
    }

    public function show($id_evento_denunciado){
        $eventoDenunciado = Evento_denunciado::find($id_evento_denunciado);
        return view('evento_denunciado.show', compact('eventoDenunciado'));
    }

    public function index(){
        $eventosDenunciados = Evento_denunciado::all();
        return view('evento_denunciado.index', compact('eventosDenunciados'));
    }

    public function getByEventoId($id_evento){
        return Evento_denunciado::where('id_evento', $id_evento)->get();
    }
}
