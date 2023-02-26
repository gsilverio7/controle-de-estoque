<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserFormRequest;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(UserService $service)
    {
        $this->service = $service;
        $this->middleware('auth');
    }

    public function ativar(Request $request)
    {
        $ids = $request->input('id');
        return response()->json($this->service->ativar($ids));
    }

    public function create()
    {
        $formUrl = route('usuarios.store');
        $tabelaUrl = route('usuarios');
        $delUrl = '';
        return view('usuarios-form')->with(compact('formUrl', 'tabelaUrl', 'delUrl'));
    }

     public function destroy(Request $request)
    {
        $id = $request->input('id');
        return response()->json($this->service->apagar($id));
    }

    public function grid(Request $request)
    {
        return response()->json($this->service->grid($request));
    }

    public function inativar(Request $request)
    {
        $ids = $request->input('id');
        return response()->json($this->service->inativar($ids));
    }

    public function index()
    {
        $novoUrl = route('usuarios.add');        
        $gridUrl = route('usuarios.grid');
        $showUrl = route('usuarios.show');
        $delUrl = route('usuarios.del');
        $nomeDownload = 'usuarios';
        return view('usuarios-tabela', compact(['novoUrl', 'gridUrl', 'showUrl', 'delUrl', 'nomeDownload']));
    }

    public function select2(Request $request)
    {
        return response()->json($this->service->select2($request));
    }

    public function show(int $id)
    {
        $usuario = $this->service->buscar($id);
        if (empty($usuario)) {
            return response()->json('Error', 500);
        }
        $formUrl = route('usuarios.update', $usuario['id']);
        $tabelaUrl = route('usuarios');
        $delUrl = route('usuarios.del');

        return view('usuarios-form')->with(compact('usuario', 'formUrl', 'tabelaUrl', 'delUrl'));
    }

    public function showMyUser()
    {
        $id = auth()->user()->id;
        $usuario = $this->service->buscar($id);
        if (empty($usuario)) {
            return response()->json('Error', 500);
        }
        $formUrl = route('usuarios.update', $usuario['id']);
        $tabelaUrl = route('usuarios');
        $delUrl = route('usuarios.del');

        return view('usuarios-form')->with(compact('usuario', 'formUrl', 'tabelaUrl', 'delUrl'));
    }

    public function store(UserFormRequest $request)
    {
        if ($this->service->criar($request->all())) {
            return response()->json(true);
        }

        return response()->json('Error', 500);
    }

    public function update(int $id, UserFormRequest $request)
    {
        if ($this->service->atualizar($id, $request->all())) {
            return response()->json(true);
        }

        return response()->json('Error', 500);
    }
}
