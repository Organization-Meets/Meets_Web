<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Redes;

class RedesController extends Controller
{
    public function create(){
        return view('redes.create');
    }

    public function store(Request $request){
        $rede = new Redes();
        $rede->id_adicionais = $request->input('id_adicionais');
        $rede->tipo_rede = $request->input('tipo_rede');
        $rede->url_redes = $request->input('url_redes');
        $rede->save();
    }

    public function edit($id_redes){
        $rede = Redes::find($id_redes);
        return view('redes.edit', compact('rede'));
    }

    public function update(Request $request, $id_redes){
        $rede = Redes::find($id_redes);
        $rede->id_adicionais = $request->input('id_adicionais');
        $rede->tipo_rede = $request->input('tipo_rede');
        $rede->url_redes = $request->input('url_redes');
        $rede->save();
        return true;
    }

    public function destroy($id_redes){
        $rede = Redes::find($id_redes);
        $rede->delete();
        return true;
    }

    public function show($id_redes){
        $rede = Redes::find($id_redes);
        return view('redes.show', compact('rede'));
    }

    public function index(){
        $redes = Redes::all();
        return view('redes.index', compact('redes'));
    }

    public function getByAdicionaisId($id_adicionais){
        return Redes::where('id_adicionais', $id_adicionais)->get();
    }
}
