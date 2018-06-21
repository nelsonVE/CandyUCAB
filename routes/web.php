<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where can register you web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::get('/tienda', function () {
    return view('tienda');
});

Route::post('registro/crear', 'UserController@crear');
Route::get('registro/juridico', 'UserController@juridico');
Route::get('registro/natural', 'UserController@natural');
Route::resource('registro', 'UserController');

Route::get('login', 'UserController@login');
Route::post('login/verificar', 'UserController@autentificar');


Route::get('estado/{estado}/municipios', 'EstadoController@getMunicipios');
Route::get('municipio/{municipio}/parroquias', 'EstadoController@getParroquias');

Route::get('/panel', 'PanelController@getIndex');
Route::get('/panel/salir', 'PanelController@logout');

Route::get('/productos', 'ProductosController@getIndex');
