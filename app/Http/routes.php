<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('app');
});

Route::group(['prefix' => 'client', 'middleware' => 'auth', 'as' => 'client.'], function () {
    Route::get('index', ['as' => 'index', 'uses' => 'MovimentacaoController@index']);
    Route::get('create', ['as' => 'create', 'uses' => 'MovimentacaoController@create']);
    Route::post('store', ['as' => 'store', 'uses' => 'MovimentacaoController@store']);
    Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'MovimentacaoController@edit']);
    Route::post('update/{id}', ['as' => 'update', 'uses' => 'MovimentacaoController@update']);
    Route::get('destroy/{id}', ['as' => 'destroy', 'uses' => 'MovimentacaoController@destroy']);
});