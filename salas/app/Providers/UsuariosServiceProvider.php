<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Facades\UsuariosFacade;

class UsuariosServiceProvider extends ServiceProvider
{
    public $singletons = [
        UsuariosFacade::class
    ];
}
