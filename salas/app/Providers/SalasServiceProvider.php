<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Facades\SalasFacade;

class SalasServiceProvider extends ServiceProvider
{
    public $singletons = [
        SalasFacade::class
    ];
}
