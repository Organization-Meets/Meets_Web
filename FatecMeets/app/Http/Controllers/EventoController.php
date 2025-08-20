<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evento;

class EventoController extends Controller
{
    public function create(){
        return view('evento.create');
    }

    public function store(Request $request){
        $evento = new Evento();
        $evento->nome_evento = $request->input('nome_evento');
        $evento->descricao = $request->input('descricao');
        $evento->data_inicio_evento = $request->input('data_inicio_evento');
        $evento->data_final_evento = $request->input('data_final_evento');
        $evento->imagem_evento = $request->input('imagem_evento');
        $evento->categoria_evento = $request->input('categoria_evento');
        $evento->id_usuario = $request->input('id_usuario');
        $evento->id_atividade = $request->input('id_atividade');
        $evento->id_lugares = $request->input('id_lugares');
        $evento->id_logradouro = $request->input('id_logradouro');
        $evento->save();
    }

    public function edit($id_evento){
        $evento = Evento::find($id_evento);
        return view('evento.edit', compact('evento'));
    }

    public function update(Request $request, $id_evento){
        $evento = Evento::find($id_evento);
        $evento->nome_evento = $request->input('nome_evento');
        $evento->descricao = $request->input('descricao');
        $evento->data_inicio_evento = $request->input('data_inicio_evento');
        $evento->data_final_evento = $request->input('data_final_evento');
        $evento->imagem_evento = $request->input('imagem_evento');
        $evento->categoria_evento = $request->input('categoria_evento');
        $evento->id_usuario = $request->input('id_usuario');
        $evento->id_atividade = $request->input('id_atividade');
        $evento->id_lugares = $request->input('id_lugares');
        $evento->id_logradouro = $request->input('id_logradouro');
        $evento->save();
        return true;
    }

    public function destroy($id_evento){
        $evento = Evento::find($id_evento);
        $evento->delete();
        return true;
    }

    public function show($id_evento){
        $evento = Evento::find($id_evento);
        return view('evento.show', compact('evento'));
    }

    public function index(){
        $eventos = Evento::all();
        return view('evento.index', compact('eventos'));
    }

    public function getByUsuarioId($id_usuario){
        return Evento::where('id_usuario', $id_usuario)->get();
    }
}
