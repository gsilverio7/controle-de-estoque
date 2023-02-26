<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function apagar($id)
    {
        return $this->repository->apagar($id);
    }

    public function atualizar(int $id, array $dados)
    {
        if (isset($dados['new_password'])) {
            $dados['password'] = Hash::make($dados['new_password']);
        }
        return $this->repository->atualizar($id, $dados);
    }

    public function buscar(int $id)
    {
        return $this->repository->buscar($id);
    }

    public function criar(array $dados)
    {
        if (isset($dados['new_password'])) {
            $dados['password'] = Hash::make($dados['new_password']);
        }
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
}
