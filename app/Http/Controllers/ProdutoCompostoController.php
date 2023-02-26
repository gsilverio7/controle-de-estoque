<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProdutoCompostoFormRequest;
use App\Services\ProdutoCompostoService;
use Illuminate\Http\Request;

class ProdutoCompostoController extends Controller
{
    public function __construct(ProdutoCompostoService $service)
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
        $formUrl = route('produtos_compostos.store');
        $tabelaUrl = route('produtos_compostos');
        $delUrl = '';
        return view('produtos-compostos-form')->with(compact('formUrl', 'tabelaUrl', 'delUrl'));
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
        $novoUrl = route('produtos_compostos.add');        
        $gridUrl = route('produtos_compostos.grid');
        $showUrl = route('produtos_compostos.show');
        $delUrl = route('produtos_compostos.del');
        $nomeDownload = 'produtos_compostos';
        return view('produtos-compostos-tabela', compact(['novoUrl', 'gridUrl', 'showUrl', 'delUrl', 'nomeDownload']));
    }

    public function select2(Request $request)
    {
        return response()->json($this->service->select2($request));
    }

    public function show(int $id)
    {
        $produto = $this->service->buscar($id);
        if (empty($produto)) {
            return response()->json('Error', 500);
        }
        $formUrl = route('produtos_compostos.update', $produto['id']);
        $tabelaUrl = route('produtos_compostos');
        $delUrl = route('produtos_compostos.del');

        return view('produtos-compostos-form')->with(compact('produto', 'formUrl', 'tabelaUrl', 'delUrl'));
    }

    public function store(ProdutoCompostoFormRequest $request)
    {
        if ($this->service->criar($request->all())) {
            return response()->json(true);
        }

        return response()->json('Error', 500);
    }

    public function update(int $id, ProdutoCompostoFormRequest $request)
    {
        if ($this->service->atualizar($id, $request->all())) {
            return response()->json(true);
        }

        return response()->json('Error', 500);
    }
}
