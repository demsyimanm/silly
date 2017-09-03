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

Route::get('/', function () {
    return redirect('login');
});

Route::get('/login', ['as' => 'login.index', 'uses' => 'Auth\LoginController@index']);
Route::post('/login', ['as' => 'login', 'uses' => 'Auth\LoginController@login']);

Route::group(['middleware' => 'auth'], function() {
	Route::group(['prefix' => 'backend'], function() {
		Route::get('/dashboard', ['as' => 'dashboard.index', 'uses' => 'Backend\HomeController@index']);
		Route::get('/logout', ['as' => 'admin.logout', 'uses' => 'Auth\LoginController@logout']);
		Route::group(['prefix' => 'kategori-informasi'], function() {
			Route::get('/index', ['as' => 'information.index', 'uses' => 'Backend\InformationController@index']);
			Route::post('/data', ['as' => 'information.data', 'uses' => 'Backend\InformationController@data']);
			Route::get('/detail/{id}', ['as' => 'information.detail', 'uses' => 'Backend\InformationController@detail']);
			Route::put('/detail/{id}', ['as' => 'information.detail.post', 'uses' => 'Backend\InformationController@update']);
			Route::post('/create', ['as' => 'information.create', 'uses' => 'Backend\InformationController@create']);
			Route::group(['prefix' => 'informasi'], function() {
				Route::get('/{id}', ['as' => 'information.list.index', 'uses' => 'Backend\InformationController@informationIndex']);
				Route::post('{id}/data', ['as' => 'information.list.data', 'uses' => 'Backend\InformationController@informationData']);
				Route::get('{id}/detail', ['as' => 'information.list.detail', 'uses' => 'Backend\InformationController@informationDetail']);
				Route::put('{id}/detail', ['as' => 'information.list.update', 'uses' => 'Backend\InformationController@informationUpdate']);
				Route::post('{id}/create', ['as' => 'information.list.create', 'uses' => 'Backend\InformationController@informationCreate']);
				Route::group(['prefix' => '{id1}/foto'], function() {
					Route::get('/{id2}', ['as' => 'information.foto.index', 'uses' => 'Backend\InformationController@fotoIndex']);
					Route::post('/{id2}/data', ['as' => 'information.foto.data', 'uses' => 'Backend\InformationController@fotoData']);
					Route::post('/{id2}/create', ['as' => 'information.foto.create', 'uses' => 'Backend\InformationController@fotoCreate']);
					Route::get('{id2}/detail/{id3}', ['as' => 'information.foto.detail', 'uses' => 'Backend\InformationController@fotoDetail']);
					Route::post('{id2}/detail/{id3}', ['as' => 'information.foto.update', 'uses' => 'Backend\InformationController@fotoUpdate']);
					Route::get('{id2}/delete/{id3}', ['as' => 'information.foto.delete', 'uses' => 'Backend\InformationController@fotoDelete']);
					Route::group(['prefix' => '{id2}/relasi'], function() {
						Route::get('/{idFoto}', ['as' => 'information.relasi.index', 'uses' => 'Backend\InformationController@relasiIndex']);
						Route::post('/{idFoto}/data', ['as' => 'information.relasi.data', 'uses' => 'Backend\InformationController@relasiData']);
						Route::post('/{idFoto}/create', ['as' => 'information.relasi.create', 'uses' => 'Backend\InformationController@relasiCreate']);
						Route::get('/{idFoto}/detail/{idrelasi}', ['as' => 'information.relasi.detail', 'uses' => 'Backend\InformationController@relasiDetail']);
						Route::post('/{idFoto}/detail/{idrelasi}', ['as' => 'information.relasi.update', 'uses' => 'Backend\InformationController@relasiUpdate']);
						Route::get('/{idFoto}/delete/{idrelasi}', ['as' => 'information.relasi.delete', 'uses' => 'Backend\InformationController@relasidelete']);
					});
				});	
				Route::get('parent/{idfoto}', ['as' => 'information.foto.parent', 'uses' => 'Backend\InformationController@getParent']);
				Route::get('parent/{idinformasi}/all', ['as' => 'information.foto.parent.all', 'uses' => 'Backend\InformationController@getParentAll']);
				Route::get('child/{idfoto}/all', ['as' => 'information.foto.child.all', 'uses' => 'Backend\InformationController@getChildAll']);
				Route::get('child/{idfoto}', ['as' => 'information.foto.child', 'uses' => 'Backend\InformationController@getChild']);
			});
		});
	});
});
//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
