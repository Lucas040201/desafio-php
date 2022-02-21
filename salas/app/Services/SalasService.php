<?php

namespace App\Services;

use App\Repositories\SalasRepository;
use Illuminate\Support\Facades\Log;

class SalasService extends Service
{

    public function __construct()
    {
        parent::__construct(new SalasRepository());
    }

}
