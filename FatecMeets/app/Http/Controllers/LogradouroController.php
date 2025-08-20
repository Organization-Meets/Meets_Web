<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Logradouro;

class LogradouroController extends Controller
{
    public function create(){
        return view('logradouro.create');
    }

    public function store(Request $request){
        $logradouro = new Logradouro();
        $logradouro->id_endereco = $request->input('id_endereco');
        $logradouro->nome_logradouro = $request->input('nome_logradouro');
        $logradouro->save();
    }

    public function edit($id_logradouro){
        $logradouro = Logradouro::find($id_logradouro);
        return view('logradouro.edit', compact('logradouro'));
    }

    public function update(Request $request, $id_logradouro){
        $logradouro = Logradouro::find($id_logradouro);
        $logradouro->id_endereco = $request->input('id_endereco');
        $logradouro->nome_logradouro = $request->input('nome_logradouro');
        $logradouro->save();
        return true;
    }

    public function destroy($id_logradouro){
        $logradouro = Logradouro::find($id_logradouro);
        $logradouro->delete();
        return true;
    }

    public function show($id_logradouro){
        $logradouro = Logradouro::find($id_logradouro);
        return view('logradouro.show', compact('logradouro'));
    }

    public function index(){
        $logradouros = Logradouro::all();
        return view('logradouro.index', compact('logradouros'));
    }

    public function getByEnderecoId($id_endereco){
        return Logradouro::where('id_endereco', $id_endereco)->get();
    }
}
