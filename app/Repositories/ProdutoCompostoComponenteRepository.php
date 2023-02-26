<?php

namespace App\Repositories;

use App\Models\ProdutoCompostoComponente;
use Illuminate\Support\Facades\DB;

class ProdutoCompostoComponenteRepository extends CrudRepository
{
    public function __construct(ProdutoCompostoComponente $model)
    {
        $this->model = $model;
    }
}
