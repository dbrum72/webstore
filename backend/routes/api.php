<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\ClienteResource;
use App\Http\Resources\ClienteEnderecoResource;
use App\Http\Resources\FabricanteResource;
use App\Http\Resources\FornecedorResource;
use App\Models\Categoria;
use App\Models\Cliente;
use App\Models\ClienteEndereco;
use App\Models\Fabricante;
use App\Models\Fornecedor;

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
    Route::get('/cliente/{id}', function (string $id) {
        return new ClienteResource(Cliente::findOrFail($id));
    });
    Route::resource('cliente', 'ClienteController', ['except'=> ['show']]);

    /**** Produto *****/
    Route::resource('produto', 'ProdutoController', ['except' => 'show']);
});


