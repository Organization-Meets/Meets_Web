<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comentario_Evento;

class ComentarioEventoController extends Controller
{
    public function create(){
        return view('comentario_evento.create');
    }

    public function store(Request $request){
        $comentarioEvento = new Comentario_Evento();
        $comentarioEvento->id_evento = $request->input('id_evento');
        $comentarioEvento->id_comentario = $request->input('id_comentario');
        $comentarioEvento->save();
    }

    public function edit($id_comentario_evento){
        $comentarioEvento = Comentario_Evento::find($id_comentario_evento);
        return view('comentario_evento.edit', compact('comentarioEvento'));
    }

    public function update(Request $request, $id_comentario_evento){
        $comentarioEvento = Comentario_Evento::find($id_comentario_evento);
        $comentarioEvento->id_evento = $request->input('id_evento');
        $comentarioEvento->id_comentario = $request->input('id_comentario');
        $comentarioEvento->save();
        return true;
    }

    public function destroy($id_comentario_evento){
        $comentarioEvento = Comentario_Evento::find($id_comentario_evento);
        $comentarioEvento->delete();
        return true;
    }

    public function show($id_comentario_evento){
        $comentarioEvento = Comentario_Evento::find($id_comentario_evento);
        return view('comentario_evento.show', compact('comentarioEvento'));
    }

    public function index(){
        $comentariosEvento = Comentario_Evento::all();
        return view('comentario_evento.index', compact('comentariosEvento'));
    }

    public function getByEventoId($id_evento){
        return Comentario_Evento::where('id_evento', $id_evento)->get();
    }

    public function getByComentarioId($id_comentario){
        return Comentario_Evento::where('id_comentario', $id_comentario)->get();
    }
}
