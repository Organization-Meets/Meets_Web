<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lugares;

class LugaresController extends Controller
{
    public function create(){
        return view('lugares.create');
    }

    public function store(Request $request){
        $lugar = new Lugares();
        $lugar->id_endereco = $request->input('id_endereco');
        $lugar->nome_lugares = $request->input('nome_lugares');
        $lugar->id_administrador = $request->input('id_administrador');
        $lugar->save();
    }

    public function edit($id_lugar){
        $lugar = Lugares::find($id_lugar);
        return view('lugares.edit', compact('lugar'));
    }

    public function update(Request $request, $id_lugar){
        $lugar = Lugares::find($id_lugar);
        $lugar->id_endereco = $request->input('id_endereco');
        $lugar->nome_lugares = $request->input('nome_lugares');
        $lugar->id_administrador = $request->input('id_administrador');
        $lugar->save();
        return true;
    }

    public function destroy($id_lugar){
        $lugar = Lugares::find($id_lugar);
        $lugar->delete();
        return true;
    }

    public function show($id_lugar){
        $lugar = Lugares::find($id_lugar);
        return view('lugares.show', compact('lugar'));
    }

    public function index(){
        $lugares = Lugares::all();
        return view('lugares.index', compact('lugares'));
    }

    public function getByEnderecoId($id_endereco){
        return Lugares::where('id_endereco', $id_endereco)->get();
    }
}