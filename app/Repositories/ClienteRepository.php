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
}
