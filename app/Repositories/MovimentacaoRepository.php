<?php

namespace App\Repositories;

use App\Models\Movimentacao;
use Illuminate\Support\Facades\DB;

class MovimentacaoRepository extends CrudRepository
{
    public function __construct(Movimentacao $model)
    {
        $this->model = $model;
    }
}
