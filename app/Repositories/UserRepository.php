<?php

namespace App\Repositories;

use App\User;
use Illuminate\Support\Facades\DB;

class UserRepository extends CrudRepository
{
    public function __construct(User $model)
    {
        $this->model = $model;
    }
}
