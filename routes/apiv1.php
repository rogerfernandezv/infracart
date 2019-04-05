<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('/carrinho')->middleware('throttle:60,1')->group(function () {
    Route::get('/', 'CarrinhoController@index');
    Route::get('/{id}', 'CarrinhoController@show');
    Route::post('/', 'CarrinhoController@store');
    Route::post('/{id}', 'CarrinhoController@store');
    Route::put('/{id}', 'CarrinhoController@update');
    Route::delete('/{id}', 'CarrinhoController@destroy');
});
