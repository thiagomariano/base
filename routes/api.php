<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");

use Illuminate\Http\Request;

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {

    $api->get('/importacao', 'App\Http\Controllers\ImportacaosController@index');

    $api->get('/importacoes', 'App\Http\Controllers\ImportacoesController@index');
    $api->get('/importacoes/{id}', 'App\Http\Controllers\ImportacoesController@show');
    $api->delete('/importacoes/{id}', 'App\Http\Controllers\ImportacoesController@destroy');
    $api->put('/importacoes/{id}', 'App\Http\Controllers\ImportacoesController@update');
    $api->post('/importacoes', 'App\Http\Controllers\ImportacoesController@store');

    $api->get('/importar', 'App\Http\Controllers\ImportacoesController@importar');



    $api->get('/despesas', 'App\Http\Controllers\DespesasController@index');
    $api->get('/despesas/{id}', 'App\Http\Controllers\DespesasController@show');
    $api->delete('/despesas/{id}', 'App\Http\Controllers\DespesasController@destroy');
    $api->put('/despesas/{id}', 'App\Http\Controllers\DespesasController@update');
    $api->post('/despesas', 'App\Http\Controllers\DespesasController@store');

    $api->get('/limites-despesas', 'App\Http\Controllers\LimitesDespesasController@index');
    $api->get('/limites-despesas/{id}', 'App\Http\Controllers\LimitesDespesasController@show');
    $api->delete('/limites-despesas/{id}', 'App\Http\Controllers\LimitesDespesasController@destroy');
    $api->put('/limites-despesas/{id}', 'App\Http\Controllers\LimitesDespesasController@update');
    $api->post('/limites-despesas', 'App\Http\Controllers\LimitesDespesasController@store');

    $api->get('/regras-gerais', 'App\Http\Controllers\RegrasGeraisController@index');
    $api->get('/regras-gerais/{id}', 'App\Http\Controllers\RegrasGeraisController@show');
    $api->delete('/regras-gerais/{id}', 'App\Http\Controllers\RegrasGeraisController@destroy');
    $api->put('/regras-gerais/{id}', 'App\Http\Controllers\RegrasGeraisController@update');
    $api->post('/regras-gerais', 'App\Http\Controllers\RegrasGeraisController@store');

});

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

/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

/*ApiRoute::version('v1', function () {
    ApiRoute::group(['namespace' => 'App\Http\Controllers\Api',
        'as' => 'api',
        'middleware' => 'bindings'
    ], function () {
        ApiRoute::get('/despesas/', 'DespesasController@index');
    });

});*/

/*
ApiRoute::version('v1', function () {

    ApiRoute::get('/despesas1', function () {
        return \App\Entities\Despesas::find(1);
    });

    ApiRoute::get('/despesas', 'App\Http\Controllers\DespesasController@index');
    ApiRoute::get('/despesas/{id}/show', 'App\Http\Controllers\DespesasController@show');
    ApiRoute::put('/despesas/{id}/edit', 'App\Http\Controllers\DespesasController@edit');
    ApiRoute::post('/despesas', 'App\Http\Controllers\DespesasController@store');

});*/






