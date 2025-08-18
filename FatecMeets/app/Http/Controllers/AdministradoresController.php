<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Administradores;
use App\Models\Usuarios;
use App\Http\controllers\InstituicaoController;
use App\Http\controllers\LugaresController;
use App\Http\controllers\LogradouroController;


class AdministradoresController extends Controller
{
    public function index()
    {
        // Lógica para exibir a lista de administradores
    }

    public function create()
    {
        return view('administradores.create', compact('administradores'));
    }

    public function store(Request $request)
    {
        $administradores = new Administradores();
        $administradores->id_usuario = $request->input('id_usuario');
        $administradores->nome_administrador = $request->input('nome_administrador');
        $administradores->save();
    }

    public function edit($id)
    {
        $administradores = Administradores::findOrFail($id);
        return view('administradores.edit', compact('administradores'));
    }

    public function update(Request $request, $id)
    {
        $administradores = Administradores::findOrFail($id);
        $administradores->id_usuario = $request->input('id_usuario');
        $administradores->nome_administrador = $request->input('nome_administrador');
        $administradores->save();
    }

    public function destroy($id)
    {
        $administradores = Administradores::findOrFail($id);
        $administradores->delete();
    }
    public function createInstituicaoForm()
    {
        return view('administradores.instituicao');
    }
    public function storeInstituicao(Request $request)
    {
        $instituicaoController = new InstituicaoController();
        return $instituicaoController->store($request);
    }
    public function createLugaresForm()
    {
        return view('administradores.lugares');
    }
    public function storeLugares(Request $request)
    {
        $lugaresController = new LugaresController();
        return $lugaresController->store($request);
    }
    public function createLogradouroForm()
    {
        return view('administradores.logradouro');
    }
    public function storeLogradouro(Request $request)
    {
        $logradouroController = new LogradouroController();
        return $logradouroController->store($request);
    }
    public function findByIDUsuario($id_usuario)
    {
        return Administradores::where('id_usuario', $id_usuario)->first();
    }
    public function isAdmin($id_usuario)
    {
        $administrador = $this->findByIDUsuario($id_usuario);
        return $administrador !== null;
    }
}