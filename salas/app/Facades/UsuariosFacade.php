<?php

namespace App\Facades;

use App\Services\UsuariosService;
use Illuminate\Support\Facades\Facade;

/**
 * @method static store(array $data)
 * @method static update(int $id_usuaio, array $data)
 * @method static delete(mixed $ids)
 * @method static show(int $id)
 * @method static index(array $data)
 */
class UsuariosFacade extends Facade
{
    public static function getFacadeAccessor()
    {
        return UsuariosService::class;
    }
}
