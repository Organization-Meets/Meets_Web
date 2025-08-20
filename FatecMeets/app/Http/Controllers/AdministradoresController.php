<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Administradores;

class AdministradoresController extends Controller
{
    public function create(){
        return view('administradores.create');
    }

    public function store(Request $request, $usuario_id){
        $administrador = new Administradores();
        $administrador->id_usuario =  $usuario_id;
        $administrador->nome_administrador = $request->input('nome_administrador');
        $administrador->save();
    }

    public function edit($id_administrador){
        $administrador = Administradores::find($id_administrador);
        return view('administradores.edit', compact('administrador'));
    }

    public function update(Request $request, $id_administrador){
        $administrador = Administradores::find($id_administrador);
        $administrador->id_usuario = $request->input('id_usuario');
        $administrador->nome_administrador = $request->input('nome_administrador');
        $administrador->save();
        return true;
    }

    public function destroy($id_administrador){
        $administrador = Administradores::find($id_administrador);
        $administrador->delete();
        return true;
    }

    public function show($id_administrador){
        $administrador = Administradores::find($id_administrador);
        return view('administradores.show', compact('administrador'));
    }

    public function index(){
        $administradores = Administradores::all();
        return view('administradores.index', compact('administradores'));
    }

    public function getByUsuarioId($usuario_id){
        return Administradores::where('id_usuario', $usuario_id)->get();
    }
}