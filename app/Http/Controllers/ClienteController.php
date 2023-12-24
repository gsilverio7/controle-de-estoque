<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClienteFormRequest;
use App\Services\ClienteService;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function __construct(ClienteService $service)
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
        $formUrl = route('clientes.store');
        $tabelaUrl = route('clientes');
        $delUrl = '';
        $googleApiKey = env('GOOGLE_API_KEY');
        return view('clientes-form')->with(compact('formUrl', 'tabelaUrl', 'delUrl', 'googleApiKey'));
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
        $novoUrl = route('clientes.add');        
        $gridUrl = route('clientes.grid');
        $showUrl = route('clientes.show');
        $delUrl = route('clientes.del');
        $nomeDownload = 'clientes';
        return view('clientes-tabela', compact(['novoUrl', 'gridUrl', 'showUrl', 'delUrl', 'nomeDownload']));
    }

    public function select2(Request $request)
    {
        return response()->json($this->service->select2($request));
    }

    public function show(int $id)
    {
        $cliente = $this->service->buscar($id);
        if (empty($cliente)) {
            return response()->json('Error', 500);
        }
        $formUrl = route('clientes.update', $cliente['id']);
        $tabelaUrl = route('clientes');
        $delUrl = route('clientes.del');
        $googleApiKey = env('GOOGLE_API_KEY');

        return view('clientes-form')->with(compact('cliente', 'formUrl', 'tabelaUrl', 'delUrl', 'googleApiKey'));
    }

    public function store(ClienteFormRequest $request)
    {
        if ($this->service->criar($request->all())) {
            return response()->json(true);
        }

        return response()->json('Error', 500);
    }

    public function update(int $id, ClienteFormRequest $request)
    {
        if ($this->service->atualizar($id, $request->all())) {
            return response()->json(true);
        }

        return response()->json('Error', 500);
    }
}
