<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Endereco;

class EnderecoController extends Controller
{
    public function create(){
        return view('endereco.create');
    }

    public function store(Request $request){
        $endereco = new Endereco();
        $endereco->numero = $request->input('numero');
        $endereco->cep = $request->input('cep');
        $endereco->save();
    }

    public function edit($id_endereco){
        $endereco = Endereco::find($id_endereco);
        return view('endereco.edit', compact('endereco'));
    }

    public function update(Request $request, $id_endereco){
        $endereco = Endereco::find($id_endereco);
        $endereco->numero = $request->input('numero');
        $endereco->cep = $request->input('cep');
        $endereco->save();
        return true;
    }

    public function destroy($id_endereco){
        $endereco = Endereco::find($id_endereco);
        $endereco->delete();
        return true;
    }

    public function show($id_endereco){
        $endereco = Endereco::find($id_endereco);
        return view('endereco.show', compact('endereco'));
    }

    public function index(){
        $enderecos = Endereco::all();
        return view('endereco.index', compact('enderecos'));
    }
}