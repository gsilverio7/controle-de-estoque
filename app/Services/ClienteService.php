<?php

namespace App\Services;

use App\Repositories\ClienteRepository;
use Illuminate\Http\Request;

class ClienteService
{
    public function __construct(ClienteRepository $repository)
    {
        $this->repository = $repository;
    }

    public function apagar($id)
    {
        return $this->repository->apagar($id);
    }

    public function atualizar(int $id, array $dados)
    {
        $dados['divida'] = $this->formataValor($dados['divida']);
        return $this->repository->atualizar($id, $dados);
    }

    public function buscar(int $id)
    {
        return $this->repository->buscar($id);
    }

    public function criar(array $dados)
    {
        $dados['divida'] = $this->formataValor($dados['divida']);
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

    private function formataValor($valor)
    {
        $valor = str_replace('.', '', $valor);
        return str_replace(',', '.', $valor);
    }
}
