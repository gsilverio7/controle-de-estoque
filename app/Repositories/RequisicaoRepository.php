<?php

namespace App\Repositories;

use App\Models\Requisicao;
use Illuminate\Support\Facades\DB;

class RequisicaoRepository extends CrudRepository
{
    public function __construct(Requisicao $model)
    {
        $this->model = $model;
    }
}
