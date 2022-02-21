<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Facades\TurmasFacade;

class TurmasServiceProvider extends ServiceProvider
{
    public $singletons = [
        TurmasFacade::class
    ];
}
