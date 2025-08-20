<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat_denunciado;

class ChatDenunciadoController extends Controller
{
    public function create(){
        return view('chat_denunciado.create');
    }

    public function store(Request $request){
        $chatDenunciado = new Chat_denunciado();
        $chatDenunciado->id_chat = $request->input('id_chat');
        $chatDenunciado->id_administrador = $request->input('id_administrador');
        $chatDenunciado->id_lixo = $request->input('id_lixo');
        $chatDenunciado->motivo_denuncia = $request->input('motivo_denuncia');
        $chatDenunciado->status_denuncia = $request->input('status_denuncia', 'pendente');
        $chatDenunciado->save();
    }

    public function edit($id_chat_denunciado){
        $chatDenunciado = Chat_denunciado::find($id_chat_denunciado);
        return view('chat_denunciado.edit', compact('chatDenunciado'));
    }

    public function update(Request $request, $id_chat_denunciado){
        $chatDenunciado = Chat_denunciado::find($id_chat_denunciado);
        $chatDenunciado->id_chat = $request->input('id_chat');
        $chatDenunciado->id_administrador = $request->input('id_administrador');
        $chatDenunciado->id_lixo = $request->input('id_lixo');
        $chatDenunciado->motivo_denuncia = $request->input('motivo_denuncia');
        $chatDenunciado->status_denuncia = $request->input('status_denuncia', $chatDenunciado->status_denuncia);
        $chatDenunciado->save();
        return true;
    }

    public function destroy($id_chat_denunciado){
        $chatDenunciado = Chat_denunciado::find($id_chat_denunciado);
        $chatDenunciado->delete();
        return true;
    }

    public function show($id_chat_denunciado){
        $chatDenunciado = Chat_denunciado::find($id_chat_denunciado);
        return view('chat_denunciado.show', compact('chatDenunciado'));
    }

    public function index(){
        $chatsDenunciados = Chat_denunciado::all();
        return view('chat_denunciado.index', compact('chatsDenunciados'));
    }

    public function getByChatId($id_chat){
        return Chat_denunciado::where('id_chat', $id_chat)->get();
    }
}
