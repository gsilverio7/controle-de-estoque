<?php

namespace App\Repositories;

use App\Models\ProdutoComposto;
use Illuminate\Support\Facades\DB;

class ProdutoCompostoRepository extends CrudRepository
{
    public function __construct(ProdutoComposto $model)
    {
        $this->model = $model;
    }
}
