<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Facades\AgendamentoFacade;

class AgendamentoServiceProvider extends ServiceProvider
{
    public $singletons = [
        AgendamentoFacade::class
    ];
}
