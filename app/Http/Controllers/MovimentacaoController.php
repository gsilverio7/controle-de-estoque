<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\MovimentacaoService;
use Illuminate\Http\Request;

class MovimentacaoController extends Controller
{
    public function __construct(MovimentacaoService $service)
    {
        $this->service = $service;
        $this->middleware('auth');
    }

    public function gerarGrafico(Request $request)
    {
        return response()->json($this->service->gerarGrafico($request));
    }

    public function gridMovimentacoes(Request $request)
    {
        return response()->json($this->service->grid($request));
    }

    public function gridEstoque(Request $request)
    {
        return response()->json($this->service->gridEstoque($request));
    }

    public function indexMovimentacoes()
    {
        $gridUrl = route('movimentacoes.grid');
        $nomeDownload = 'movimentacoes';
        return view('movimentacoes-tabela', compact(['gridUrl', 'nomeDownload']));
    }

    public function indexEstoque()
    {
        $gridUrl = route('estoque.grid');
        $nomeDownload = 'estoque';
        return view('estoque-tabela', compact(['gridUrl', 'nomeDownload']));
    }
}
