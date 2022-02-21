<?php

namespace App\Repositories;

use App\Models\Salas;

class SalasRepository extends Repository
{
    public function __construct()
    {
        parent::__construct(new Salas());
    }
}
