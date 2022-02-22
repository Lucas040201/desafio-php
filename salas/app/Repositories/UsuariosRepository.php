<?php

namespace App\Repositories;

use App\Models\Usuarios;


class UsuariosRepository extends Repository
{

    public function __construct()
    {
        parent::__construct(new Usuarios());
    }

}
