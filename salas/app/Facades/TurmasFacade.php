<?php

namespace App\Facades;

use App\Services\TurmasService;
use Illuminate\Support\Facades\Facade;

/**
 * @method static store(array $data)
 * @method static update(int $id_turma, array $data)
 * @method static delete(mixed $ids)
 * @method static show(int $id)
 * @method static index(array $data)
 */
class TurmasFacade extends Facade
{
    public static function getFacadeAccessor()
    {
        return TurmasService::class;
    }
}
