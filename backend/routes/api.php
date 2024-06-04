<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\ClienteResource;
use App\Http\Resources\ProdutoResource;
use App\Http\Resources\PedidoResource;
use App\Models\Cliente;
use App\Models\Produto;
use App\Models\Pedido;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([

    'middleware' => 'api',
    'namespace' => 'App\Http\Controllers',
    'prefix' => 'auth'

], function ($router) {
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
});

Route::group([

    'middleware' => ['api','jwt.auth'],
    'namespace' => 'App\Http\Controllers',

], function ($router) {

    /**** Cliente *****/
    Route::resource('/cliente', 'ClienteController', ['except' => ['show','create','edit']]);
    Route::get('/cliente/{cliente}', function (string $cliente) {
        return new ClienteResource(Cliente::findOrFail($cliente));
    });
    

    /**** Produto *****/
    Route::resource('/produto', 'ProdutoController', ['except' => ['show','create','edit']]);
    Route::get('/produto/{produto}', function (string $produto) {
        return new ProdutoResource(Produto::findOrFail($produto));
    });


    /**** Pedido *****/
    Route::resource('/pedido', 'PedidoController', ['except' => ['show','create','edit']]);
    Route::get('/pedido/{pedido}', function (string $pedido) {
        return new PedidoResource(Pedido::findOrFail($pedido));
    });
});


