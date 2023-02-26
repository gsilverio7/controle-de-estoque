<?php

namespace App\Services;

use App\Repositories\MovimentacaoRepository;
use App\Repositories\ProdutoSimplesRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MovimentacaoService
{
    public function __construct(MovimentacaoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function apagar($id)
    {
        return $this->repository->apagar($id);
    }

    public function atualizar(int $id, array $dados)
    {
        return $this->repository->atualizar($id, $dados);
    }

    public function buscar(int $id)
    {
        return $this->repository->buscar($id);
    }

    public function criar(array $dados)
    {
        return $this->repository->criar($dados);
    }

    public function grid(Request $request)
    {
        $tipo = $request->tipo ?? 't';
        $inicio = $this->formataData($request->inicio);
        $fim = $this->formataData($request->fim);


        $query = DB::table('movimentacoes')
            ->leftJoin('requisicoes', 'requisicoes.id', '=', 'movimentacoes.id_requisicao')
            ->leftJoin('users', 'users.id', '=', 'requisicoes.id_user')
            ->leftJoin('produtos_simples', 'produtos_simples.id', '=', 'movimentacoes.id_produto_simples')
            ->leftJoin('produtos_compostos', 'produtos_compostos.id', '=', 'movimentacoes.id_produto_composto')
            ->leftJoin('produtos_compostos_componentes', 'produtos_compostos_componentes.id_produto_composto', '=', 'produtos_compostos.id')
            ->leftJoin('produtos_simples as componentes', 'componentes.id', '=', 'produtos_compostos_componentes.id_produto_simples')
                ->groupBy('movimentacoes.id');

            if ($tipo != 't') {
                $query = $query->where('requisicoes.tipo', '=', $tipo);
            }
            if ($inicio != '') {
                $query = $query->where('requisicoes.created_at', '>=', $inicio);
            }
            if ($fim != '') {
                $query = $query->where('requisicoes.created_at', '<=', $fim);
            }

            return $query->select(
                'movimentacoes.id', 
                'requisicoes.tipo as tipo', 
                DB::raw('DATE_FORMAT(requisicoes.created_at, "%d/%m/%Y %H:%i:%s") as data'), 
                'users.name as responsavel', 
                DB::raw('COALESCE(produtos_simples.nome, produtos_compostos.nome) as produto'),
                DB::raw('COALESCE(produtos_simples.preco_venda, produtos_compostos.preco_venda) as preco_venda'),
                DB::raw('COALESCE(produtos_simples.preco_custo, SUM(componentes.preco_custo * produtos_compostos_componentes.quantidade)) as preco_custo'),
                'movimentacoes.quantidade',
            )->get();        
    }

    public function gridEstoque(Request $request)
    {
        $movimentacoes = $this->repository->grid(
            ['requisicao', 'produtoSimples', 'produtoComposto.componentes.produtoSimples']
        );

        $produtos = [];
        $nome = [];
        $quantidade = [];

        foreach ($movimentacoes as $movimentacao) {
            if ($movimentacao['requisicao']['tipo'] == 'Compra') {
                $sinal = 1;
            } else {
                $sinal = -1;
            }

            if (is_null($movimentacao['id_produto_composto'])) {
                if (in_array($movimentacao['id_produto_simples'], $produtos)) {
                    $key = array_search($movimentacao['id_produto_simples'], $produtos);
                    $quantidade[$key] += ($movimentacao['quantidade'] * $sinal);
                } else {
                    array_push($produtos, $movimentacao['id_produto_simples']);
                    array_push($quantidade, $movimentacao['quantidade'] * $sinal);
                    array_push($nome, $movimentacao['produto_simples']['nome']);
                }
            } else {
                foreach ($movimentacao['produto_composto']['componentes'] as $componente) {
                    if (in_array($componente['id_produto_simples'], $produtos)) {
                        $key = array_search($componente['id_produto_simples'], $produtos);
                        $quantidade[$key] += ($componente['quantidade'] * $sinal * $movimentacao['quantidade']);
                    } else {
                        array_push($produtos, $componente['id_produto_simples']);
                        array_push($quantidade, $componente['quantidade'] * $sinal * $movimentacao['quantidade']);
                        array_push($nome, $componente['produto_simples']['nome']);
                    }
                }
            }
        }

        $retorno = [];
        foreach ($produtos as $key => $produto) {
            $retorno[$key]['produto'] = $produto;
            $retorno[$key]['quantidade'] = $quantidade[$key];
            $retorno[$key]['nome'] = $nome[$key];
        }
        return $retorno;
    }

    public function select2(Request $request)
    {
        return $this->repository->select2($request->all());
    }

    private function formataData($data)
    {
        try {
            return Carbon::createFromFormat('d/m/Y H:i:s', $data)->format('Y-m-d H:i:s');
        } catch (\Exception $e) {
            return '';
        }
    }
}
