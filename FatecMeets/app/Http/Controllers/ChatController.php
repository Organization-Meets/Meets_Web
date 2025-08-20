<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;

class ChatController extends Controller
{
    public function create(){
        return view('chat.create');
    }

    public function store(Request $request){
        $chat = new Chat();
        $chat->nome_chat = $request->input('nome_chat');
        $chat->tipo_chat = $request->input('tipo_chat', 'privado');
        $chat->save();
    }

    public function edit($id_chat){
        $chat = Chat::find($id_chat);
        return view('chat.edit', compact('chat'));
    }

    public function update(Request $request, $id_chat){
        $chat = Chat::find($id_chat);
        $chat->nome_chat = $request->input('nome_chat');
        $chat->tipo_chat = $request->input('tipo_chat', $chat->tipo_chat);
        $chat->save();
        return true;
    }

    public function destroy($id_chat){
        $chat = Chat::find($id_chat);
        $chat->delete();
        return true;
    }

    public function show($id_chat){
        $chat = Chat::find($id_chat);
        return view('chat.show', compact('chat'));
    }

    public function index(){
        $chats = Chat::all();
        return view('chat.index', compact('chats'));
    }
}
