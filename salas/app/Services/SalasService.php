<?php

namespace App\Services;

use App\Repositories\SalasRepository;

class SalasService extends Service
{

    public function __construct()
    {
        parent::__construct(new SalasRepository());
    }

}
