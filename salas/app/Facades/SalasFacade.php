<?php

namespace App\Facades;

use App\Services\SalasService;
use Illuminate\Support\Facades\Facade;

/**
 * @method static store(array $data)
 * @method static update(int $id_sala, array $data)
 * @method static delete(mixed $ids)
 * @method static show(int $id)
 * @method static index(array $data)
 */
class SalasFacade extends Facade
{
    public static function getFacadeAccessor()
    {
        return SalasService::class;
    }
}
