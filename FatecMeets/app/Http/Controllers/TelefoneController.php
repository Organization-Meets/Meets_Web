<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Telefone;

class TelefoneController extends Controller
{
    public function create(){
        return view('telefone.create');
    }

    public function store(Request $request){
        $telefone = new Telefone();
        $telefone->numero_telefone = $request->input('numero_telefone');
        $telefone->ddd = $request->input('ddd');
        $telefone->tipo_telefone = $request->input('tipo_telefone', 'celular');
        $telefone->save();
    }

    public function edit($id_telefone){
        $telefone = Telefone::find($id_telefone);
        return view('telefone.edit', compact('telefone'));
    }

    public function update(Request $request, $id_telefone){
        $telefone = Telefone::find($id_telefone);
        $telefone->numero_telefone = $request->input('numero_telefone');
        $telefone->ddd = $request->input('ddd');
        $telefone->tipo_telefone = $request->input('tipo_telefone', $telefone->tipo_telefone);
        $telefone->save();
        return true;
    }

    public function destroy($id_telefone){
        $telefone = Telefone::find($id_telefone);
        $telefone->delete();
        return true;
    }

    public function show($id_telefone){
        $telefone = Telefone::find($id_telefone);
        return view('telefone.show', compact('telefone'));
    }

    public function index(){
        $telefones = Telefone::all();
        return view('telefone.index', compact('telefones'));
    }
}
