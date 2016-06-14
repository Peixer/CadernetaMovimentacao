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
    return view('home');
});

Route::get('/home', ['as' => 'home', function () {
    return view('home');
}]);

Route::group(['prefix' => 'auth', 'as' => 'auth.'], function () {
    Route::get('facebook', 'Auth\AuthController@redirectToProvider');
    Route::get('facebook/callback', 'Auth\AuthController@handleProviderCallback');
});

Route::group(['prefix' => 'client', 'middleware' => 'auth', 'as' => 'client.'], function () {
    Route::get('index', ['as' => 'index', 'uses' => 'MovimentacaoController@index']);
    Route::get('create', ['as' => 'create', 'uses' => 'MovimentacaoController@create']);
    Route::post('store', ['as' => 'store', 'uses' => 'MovimentacaoController@store']);
    Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'MovimentacaoController@edit']);
    Route::post('update/{id}', ['as' => 'update', 'uses' => 'MovimentacaoController@update']);
    Route::get('destroy/{id}', ['as' => 'destroy', 'uses' => 'MovimentacaoController@destroy']);

    Route::get('historic', ['as' => 'historic', 'uses' => 'MovimentacaoController@historic']);
    Route::get('filterHistoric/{mes}', ['as' => 'filterHistoric', 'uses' => 'MovimentacaoController@getHistoric']);

    Route::get('report', ['as' => 'report', 'uses' => 'MovimentacaoController@report']);
    Route::post('filterReport', ['as' => 'filterReport', 'uses' => 'MovimentacaoController@getReport']);
});

Route::group(['middleware' => 'cors'], function () {
    Route::post('oauth/access_token', function () {
        return Response::json(Authorizer::issueAccessToken());
    });

    Route::group(['prefix' => 'api', 'middleware' => 'oauth', 'as' => 'api.'], function () {
        Route::get('autenticarUsuario', 'API\UserController@autenticarUsuario');

        Route::get('movimentos', 'API\MovimentosController@listar');
        Route::get('movimentosFavoritos', 'API\MovimentosController@obterMovimentosFavoritos');
        Route::get('deletarMovimento/{id}', 'API\MovimentosController@deletarMovimento');
        Route::get('alterarStatusFavorito/{id}', 'API\MovimentosController@alterarStatusFavorito');
        Route::post('inserirOuAtualizar', 'API\MovimentosController@inserirOuAtualizar');
    });
});