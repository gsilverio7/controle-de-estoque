<?php

namespace App\Repositories;

use App\Models\ProdutoSimples;
use Illuminate\Support\Facades\DB;

class ProdutoSimplesRepository extends CrudRepository
{
    public function __construct(ProdutoSimples $model)
    {
        $this->model = $model;
    }
}
