<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('App\Http\Controllers\Api')->group(function () {

    Route::prefix('agendamento')->group(function () {
        Route::post('sala/{id_sala}', 'AgendamentoController@store');
        Route::get('/', 'AgendamentoController@index');
        Route::delete('/', 'AgendamentoController@delete');

        Route::prefix('{id}')->group(function () {
            Route::put('/', 'AgendamentoController@update');
            Route::delete('/', 'AgendamentoController@delete');
            Route::get('/', 'AgendamentoController@show');
        });
    });


    Route::prefix('sala')->group(function () {

        Route::post('/', 'SalasController@store');
        Route::get('/', 'SalasController@index');
        Route::delete('/', 'SalasController@delete');

        Route::prefix('{id}')->group(function () {
            Route::put('/', 'SalasController@update');
            Route::delete('/', 'SalasController@delete');
            Route::get('/', 'SalasController@show');
        });
    });

    Route::prefix('turma')->group(function () {

        Route::post('/', 'TurmasController@store');
        Route::get('/', 'TurmasController@index');
        Route::delete('/', 'TurmasController@delete');

        Route::prefix('{id}')->group(function () {
            Route::put('/', 'TurmasController@update');
            Route::delete('/', 'TurmasController@delete');
            Route::get('/', 'TurmasController@show');
        });
    });

    Route::prefix('usuario')->group(function () {

        Route::post('/', 'UsuariosController@store');
        Route::get('/', 'UsuariosController@index');
        Route::delete('/', 'UsuariosController@delete');

        Route::prefix('{id}')->group(function () {
            Route::put('/', 'UsuariosController@update');
            Route::delete('/', 'UsuariosController@delete');
            Route::get('/', 'UsuariosController@show');
        });
    });
});
