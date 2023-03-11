<?php

namespace App\Repositories;

use App\Models\Cliente;
use Illuminate\Support\Facades\DB;

class ClienteRepository extends CrudRepository
{
    public function __construct(Cliente $model)
    {
        $this->model = $model;
    }

    /*
    public function gridCliente(array $relacionamentos = [])
    {
        try {
            $model = $this->model;
            if (! empty($relacionamentos)) {
                $model = $model::with($relacionamentos);
            }
            
            dd($model->select(
                'id',
                'nome',
                \DB::raw('IF(tipo = "f", cpf, cnpj) AS doc')
            )->get()->toArray());

            return $model->get()->toArray();
        } catch (\Exception $e) {
            return [];
        }
    }
    */
}
