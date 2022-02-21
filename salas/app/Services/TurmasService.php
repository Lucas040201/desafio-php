<?php

namespace App\Services;

use App\Repositories\TurmasRepository;

class TurmasService extends Service
{

    public function __construct()
    {
        parent::__construct(new TurmasRepository());
    }
}