<?php

namespace App\Repositories;

use App\Models\Turmas;

class TurmasRepository extends Repository
{

    public function __construct()
    {
        parent::__construct(new Turmas());
    }

}
