<?php

namespace App\Repositories;

use App\Models\Usuarios;
use Illuminate\Support\Facades\Log;


class UsuariosRepository extends Repository
{

    public function __construct()
    {
        parent::__construct(new Usuarios());
    }

}
