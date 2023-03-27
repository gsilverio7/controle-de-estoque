<?php

namespace App\Repositories;

abstract class CrudRepository
{
    public function apagar(int $id)
    {
        try {
            $this->model::find($id)->delete();
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function atualizar(int $id, array $dados)
    {
        try {
            $this->model::find($id)->update($dados);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function buscar(int $id, array $relacionamentos = [])
    {
        try {
            $model = $this->model;
            if (! empty($relacionamentos)) {
                $model = $model::with($relacionamentos);
            }
            return $model->find($id)->toArray();
        } catch (\Exception $e) {
            return [];
        }
    }

    public function criar(array $dados)
    {
        try {
            $this->model::create($dados);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function criarRetornaId(array $dados)
    {
        try {
            $id = $this->model::create($dados)->id;
            return $id;
        } catch (\Exception $e) {
            return 0;
        }
    }

    public function grid(array $relacionamentos = [], array $filtros = [])
    {
        try {
            $model = $this->model;

            if (! empty($relacionamentos)) {
                $model = $model->with($relacionamentos);
            }

            if (! empty($filtros)) {
                foreach ($filtros as $filtro) {
                    $model = $model->where($filtro[0], $filtro[1], $filtro[2]);
                }
            }

            return $model->get()->toArray();
        } catch (\Exception $e) {
            return [];
        }
    }

    public function select2(array $filtros)
    {
        $model = $this->model;
        $pesquisa = $filtros['q'] ?? '';
        if ($pesquisa != '') {
            $pesquisa = '%' . $pesquisa . '%';
            $model = $model->where('nome', 'like', $pesquisa);
        }
        $retorno = [];
        $retorno['results'] = $model->select('id', 'nome as text')->get()->toArray();

        return $retorno;
    }
}
