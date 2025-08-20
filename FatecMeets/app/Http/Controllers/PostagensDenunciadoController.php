<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Postagens_denunciado;

class PostagensDenunciadoController extends Controller
{
    public function create(){
        return view('postagens_denunciado.create');
    }

    public function store(Request $request){
        $postagemDenunciada = new Postagens_denunciado();
        $postagemDenunciada->id_postagem = $request->input('id_postagem');
        $postagemDenunciada->id_administrador = $request->input('id_administrador');
        $postagemDenunciada->id_lixo = $request->input('id_lixo');
        $postagemDenunciada->motivo_denuncia = $request->input('motivo_denuncia');
        $postagemDenunciada->status_denuncia = $request->input('status_denuncia', 'pendente');
        $postagemDenunciada->save();
    }

    public function edit($id_postagens_denunciado){
        $postagemDenunciada = Postagens_denunciado::find($id_postagens_denunciado);
        return view('postagens_denunciado.edit', compact('postagemDenunciada'));
    }

    public function update(Request $request, $id_postagens_denunciado){
        $postagemDenunciada = Postagens_denunciado::find($id_postagens_denunciado);
        $postagemDenunciada->id_postagem = $request->input('id_postagem');
        $postagemDenunciada->id_administrador = $request->input('id_administrador');
        $postagemDenunciada->id_lixo = $request->input('id_lixo');
        $postagemDenunciada->motivo_denuncia = $request->input('motivo_denuncia');
        $postagemDenunciada->status_denuncia = $request->input('status_denuncia', $postagemDenunciada->status_denuncia);
        $postagemDenunciada->save();
        return true;
    }

    public function destroy($id_postagens_denunciado){
        $postagemDenunciada = Postagens_denunciado::find($id_postagens_denunciado);
        $postagemDenunciada->delete();
        return true;
    }

    public function show($id_postagens_denunciado){
        $postagemDenunciada = Postagens_denunciado::find($id_postagens_denunciado);
        return view('postagens_denunciado.show', compact('postagemDenunciada'));
    }

    public function index(){
        $postagensDenunciadas = Postagens_denunciado::all();
        return view('postagens_denunciado.index', compact('postagensDenunciadas'));
    }

    public function getByPostagemId($id_postagem){
        return Postagens_denunciado::where('id_postagem', $id_postagem)->get();
    }
}
