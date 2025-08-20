<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mensagens_denunciado;

class MensagensDenunciadoController extends Controller
{
    public function create(){
        return view('mensagens_denunciado.create');
    }

    public function store(Request $request){
        $mensagemDenunciada = new Mensagens_denunciado();
        $mensagemDenunciada->id_mensagens = $request->input('id_mensagens');
        $mensagemDenunciada->id_administrador = $request->input('id_administrador');
        $mensagemDenunciada->id_lixo = $request->input('id_lixo');
        $mensagemDenunciada->motivo_denuncia = $request->input('motivo_denuncia');
        $mensagemDenunciada->status_denuncia = $request->input('status_denuncia', 'pendente');
        $mensagemDenunciada->save();
    }

    public function edit($id_mensagens_denunciado){
        $mensagemDenunciada = Mensagens_denunciado::find($id_mensagens_denunciado);
        return view('mensagens_denunciado.edit', compact('mensagemDenunciada'));
    }

    public function update(Request $request, $id_mensagens_denunciado){
        $mensagemDenunciada = Mensagens_denunciado::find($id_mensagens_denunciado);
        $mensagemDenunciada->id_mensagens = $request->input('id_mensagens');
        $mensagemDenunciada->id_administrador = $request->input('id_administrador');
        $mensagemDenunciada->id_lixo = $request->input('id_lixo');
        $mensagemDenunciada->motivo_denuncia = $request->input('motivo_denuncia');
        $mensagemDenunciada->status_denuncia = $request->input('status_denuncia', $mensagemDenunciada->status_denuncia);
        $mensagemDenunciada->save();
        return true;
    }

    public function destroy($id_mensagens_denunciado){
        $mensagemDenunciada = Mensagens_denunciado::find($id_mensagens_denunciado);
        $mensagemDenunciada->delete();
        return true;
    }

    public function show($id_mensagens_denunciado){
        $mensagemDenunciada = Mensagens_denunciado::find($id_mensagens_denunciado);
        return view('mensagens_denunciado.show', compact('mensagemDenunciada'));
    }

    public function index(){
        $mensagensDenunciadas = Mensagens_denunciado::all();
        return view('mensagens_denunciado.index', compact('mensagensDenunciadas'));
    }

    public function getByMensagensId($id_mensagens){
        return Mensagens_denunciado::where('id_mensagens', $id_mensagens)->get();
    }
}
