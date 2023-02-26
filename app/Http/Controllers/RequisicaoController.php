<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\RequisicaoService;
use Illuminate\Http\Request;

class RequisicaoController extends Controller
{
    public function __construct(RequisicaoService $service)
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
        $formUrl = route('requisicoes.store');
        $tabelaUrl = route('requisicoes');
        $delUrl = '';
        return view('requisicoes-form')->with(compact('formUrl', 'tabelaUrl', 'delUrl'));
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
        $novoUrl = route('requisicoes.add');        
        $gridUrl = route('requisicoes.grid');
        $showUrl = route('requisicoes.show');
        $delUrl = route('requisicoes.del');
        $nomeDownload = 'requisicoes';
        return view('requisicoes-tabela', compact(['novoUrl', 'gridUrl', 'showUrl', 'delUrl', 'nomeDownload']));
    }

    public function select2(Request $request)
    {
        return response()->json($this->service->select2($request));
    }

    public function show(int $id)
    {
        $requisicao = $this->service->buscar($id);
        if (empty($requisicao)) {
            return response()->json('Error', 500);
        }
        $formUrl = route('requisicoes.update', $requisicao['id']);
        $tabelaUrl = route('requisicoes');
        $delUrl = route('requisicoes.del');

        return view('requisicoes-form')->with(compact('requisicao', 'formUrl', 'tabelaUrl', 'delUrl'));
    }

    public function store(Request $request)
    {
        if ($this->service->criar($request->all())) {
            return response()->json(true);
        }

        return response()->json('Error', 500);
    }

    public function update(int $id, Request $request)
    {
        if ($this->service->atualizar($id, $request->all())) {
            return response()->json(true);
        }

        return response()->json('Error', 500);
    }
}
