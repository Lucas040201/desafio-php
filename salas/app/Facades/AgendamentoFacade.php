<?php

namespace App\Facades;

use App\Services\AgendamentoService;
use Illuminate\Support\Facades\Facade;

/**
 * @method static store(array $data)
 * @method static update(int $id_agendamento, array $data)
 * @method static delete(mixed $ids)
 * @method static show(int $id)
 * @method static index(array $data)
 */

class AgendamentoFacade extends Facade
{

    public static function getFacadeAccessor()
    {
        return AgendamentoService::class;
    }
}
