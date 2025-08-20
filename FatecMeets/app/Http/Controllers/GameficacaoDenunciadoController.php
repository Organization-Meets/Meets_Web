<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gameficacao_denunciado;

class GameficacaoDenunciadoController extends Controller
{
    public function create(){
        return view('gameficacao_denunciado.create');
    }

    public function store(Request $request){
        $gameficacaoDenunciado = new Gameficacao_denunciado();
        $gameficacaoDenunciado->id_gameficacao = $request->input('id_gameficacao');
        $gameficacaoDenunciado->id_administrador = $request->input('id_administrador');
        $gameficacaoDenunciado->id_lixo = $request->input('id_lixo');
        $gameficacaoDenunciado->motivo_denuncia = $request->input('motivo_denuncia');
        $gameficacaoDenunciado->status_denuncia = $request->input('status_denuncia', 'pendente');
        $gameficacaoDenunciado->save();
    }

    public function edit($id_gameficacao_denunciado){
        $gameficacaoDenunciado = Gameficacao_denunciado::find($id_gameficacao_denunciado);
        return view('gameficacao_denunciado.edit', compact('gameficacaoDenunciado'));
    }

    public function update(Request $request, $id_gameficacao_denunciado){
        $gameficacaoDenunciado = Gameficacao_denunciado::find($id_gameficacao_denunciado);
        $gameficacaoDenunciado->id_gameficacao = $request->input('id_gameficacao');
        $gameficacaoDenunciado->id_administrador = $request->input('id_administrador');
        $gameficacaoDenunciado->id_lixo = $request->input('id_lixo');
        $gameficacaoDenunciado->motivo_denuncia = $request->input('motivo_denuncia');
        $gameficacaoDenunciado->status_denuncia = $request->input('status_denuncia', $gameficacaoDenunciado->status_denuncia);
        $gameficacaoDenunciado->save();
        return true;
    }

    public function destroy($id_gameficacao_denunciado){
        $gameficacaoDenunciado = Gameficacao_denunciado::find($id_gameficacao_denunciado);
        $gameficacaoDenunciado->delete();
        return true;
    }

    public function show($id_gameficacao_denunciado){
        $gameficacaoDenunciado = Gameficacao_denunciado::find($id_gameficacao_denunciado);
        return view('gameficacao_denunciado.show', compact('gameficacaoDenunciado'));
    }

    public function index(){
        $gameficacoesDenunciadas = Gameficacao_denunciado::all();
        return view('gameficacao_denunciado.index', compact('gameficacoesDenunciadas'));
    }

    public function getByGameficacaoId($id_gameficacao){
        return Gameficacao_denunciado::where('id_gameficacao', $id_gameficacao)->get();
    }
}
