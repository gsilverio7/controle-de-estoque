<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/home', function () {
    return redirect('/');
});

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::group(['prefix' => 'produtos-simples'], function () {
    Route::get('/', 'ProdutoSimplesController@index')
        ->name('produtos_simples');
    Route::get('listagem', 'ProdutoSimplesController@grid')
        ->name('produtos_simples.grid');
    Route::get('novo', 'ProdutoSimplesController@create')
        ->name('produtos_simples.add');
    Route::get('{idProduto?}', 'ProdutoSimplesController@show')
        ->where('idProduto', '[0-9]+')
        ->name('produtos_simples.show');
    Route::put('{idProduto}', 'ProdutoSimplesController@update')
        ->where('idProduto', '[0-9]+')
        ->name('produtos_simples.update');
    Route::post('salvar', 'ProdutoSimplesController@store')
        ->name('produtos_simples.store');
    Route::delete('/', 'ProdutoSimplesController@destroy')
        ->name('produtos_simples.del');
    Route::get('select2', 'ProdutoSimplesController@select2')
        ->name('produtos_simples.cbo');
});

Route::group(['prefix' => 'produtos-compostos'], function () {
    Route::get('/', 'ProdutoCompostoController@index')
        ->name('produtos_compostos');
    Route::get('listagem', 'ProdutoCompostoController@grid')
        ->name('produtos_compostos.grid');
    Route::get('novo', 'ProdutoCompostoController@create')
        ->name('produtos_compostos.add');
    Route::get('{idProduto?}', 'ProdutoCompostoController@show')
        ->where('idProduto', '[0-9]+')
        ->name('produtos_compostos.show');
    Route::put('{idProduto}', 'ProdutoCompostoController@update')
        ->where('idProduto', '[0-9]+')
        ->name('produtos_compostos.update');
    Route::post('salvar', 'ProdutoCompostoController@store')
        ->name('produtos_compostos.store');
    Route::delete('/', 'ProdutoCompostoController@destroy')
        ->name('produtos_compostos.del');
    Route::get('select2', 'ProdutoCompostoController@select2')
        ->name('produtos_compostos.cbo');
});

Route::group(['prefix' => 'requisicoes'], function () {
    Route::get('/', 'RequisicaoController@index')
        ->name('requisicoes');
    Route::get('listagem', 'RequisicaoController@grid')
        ->name('requisicoes.grid');
    Route::get('novo', 'RequisicaoController@create')
        ->name('requisicoes.add');
    Route::get('{idRequisicao?}', 'RequisicaoController@show')
        ->where('idRequisicao', '[0-9]+')
        ->name('requisicoes.show');
    Route::put('{idRequisicao}', 'RequisicaoController@update')
        ->where('idRequisicao', '[0-9]+')
        ->name('requisicoes.update');
    Route::post('salvar', 'RequisicaoController@store')
        ->name('requisicoes.store');
    Route::delete('/', 'RequisicaoController@destroy')
        ->name('requisicoes.del');
});

Route::group(['prefix' => 'movimentacoes'], function () {
    Route::get('/', 'MovimentacaoController@indexMovimentacoes')
        ->name('movimentacoes');
    Route::get('listagem', 'MovimentacaoController@gridMovimentacoes')
        ->name('movimentacoes.grid');;
});

Route::group(['prefix' => 'estoque'], function () {
    Route::get('/', 'MovimentacaoController@indexEstoque')
        ->name('estoque');
    Route::get('listagem', 'MovimentacaoController@gridEstoque')
        ->name('estoque.grid');;
});

Route::group(['prefix' => 'usuarios'], function () {
    Route::get('/', 'UserController@index')
        ->name('usuarios');
    Route::get('listagem', 'UserController@grid')
        ->name('usuarios.grid');
    Route::get('novo', 'UserController@create')
        ->name('usuarios.add');
    Route::get('{idUsuario?}', 'UserController@show')
        ->where('idUsuario', '[0-9]+')
        ->name('usuarios.show');
    Route::put('{idUsuario}', 'UserController@update')
        ->where('idUsuario', '[0-9]+')
        ->name('usuarios.update');
    Route::post('salvar', 'UserController@store')
        ->name('usuarios.store');
    Route::delete('/', 'UserController@destroy')
        ->name('usuarios.del');
    Route::get('/meu-usuario', 'UserController@showMyUser');
});


