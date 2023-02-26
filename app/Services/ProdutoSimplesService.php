<?php

namespace App\Services;

use App\Repositories\ProdutoSimplesRepository;
use Illuminate\Http\Request;

class ProdutoSimplesService
{
    public function __construct(ProdutoSimplesRepository $repository)
    {
        $this->repository = $repository;
    }

    public function apagar($id)
    {
        return $this->repository->apagar($id);
    }

    public function atualizar(int $id, array $dados)
    {
        $dados['preco_custo'] = $this->formataPreco($dados['preco_custo']);
        $dados['preco_venda'] = $this->formataPreco($dados['preco_venda']);
        return $this->repository->atualizar($id, $dados);
    }

    public function buscar(int $id)
    {
        return $this->repository->buscar($id);
    }

    public function criar(array $dados)
    {
        $dados['preco_custo'] = $this->formataPreco($dados['preco_custo']);
        $dados['preco_venda'] = $this->formataPreco($dados['preco_venda']);
        return $this->repository->criar($dados);
    }

    public function grid(Request $request)
    {
        return $this->repository->grid();
    }

    public function select2(Request $request)
    {
        return $this->repository->select2($request->all());
    }

    private function formataPreco($preco)
    {
        $preco = str_replace('.', '', $preco);
        return str_replace(',', '.', $preco);
    }
}
