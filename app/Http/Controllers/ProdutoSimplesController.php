<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProdutoSimplesFormRequest;
use App\Services\ProdutoSimplesService;
use Illuminate\Http\Request;

class ProdutoSimplesController extends Controller
{
    public function __construct(ProdutoSimplesService $service)
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
        $formUrl = route('produtos_simples.store');
        $tabelaUrl = route('produtos_simples');
        $delUrl = '';
        return view('produtos-simples-form')->with(compact('formUrl', 'tabelaUrl', 'delUrl'));
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
        $novoUrl = route('produtos_simples.add');        
        $gridUrl = route('produtos_simples.grid');
        $showUrl = route('produtos_simples.show');
        $delUrl = route('produtos_simples.del');
        $nomeDownload = 'produtos_simples';
        return view('produtos-simples-tabela', compact(['novoUrl', 'gridUrl', 'showUrl', 'delUrl', 'nomeDownload']));
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
        //dd($produto);
        $formUrl = route('produtos_simples.update', $produto['id']);
        $tabelaUrl = route('produtos_simples');
        $delUrl = route('produtos_simples.del');

        return view('produtos-simples-form')->with(compact('produto', 'formUrl', 'tabelaUrl', 'delUrl'));
    }

    public function store(ProdutoSimplesFormRequest $request)
    {
        if ($this->service->criar($request->all())) {
            return response()->json(true);
        }

        return response()->json('Error', 500);
    }

    public function update(int $id, ProdutoSimplesFormRequest $request)
    {
        if ($this->service->atualizar($id, $request->all())) {
            return response()->json(true);
        }

        return response()->json('Error', 500);
    }
}
