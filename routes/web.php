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

Route::get('/panel/tienda', 'TiendaController@getIndex');
Route::get('/panel/tienda/candy', 'TiendaController@getShop');
Route::post('/panel/tienda/sitio', 'TiendaController@setSitio');
Route::get('/panel/tienda/candy/agregar/{id_car}', 'TiendaController@addCarrito');

Route::get('/productos', 'ProductosController@getIndex');

Route::get('/importar/excel', 'ExcelController@importarExcel');

Route::get('/admin', 'AdminController@getIndex');
Route::get('/admin/notificaciones', 'AdminController@notificaciones');
Route::get('/admin/hacerinv', 'AdminController@makeInventario');
Route::get('/admin/reponer/{tienda}', 'AdminController@reponerInventario');
Route::get('/admin/tiendas/{estado?}', 'TiendaController@verTiendas');
Route::get('/admin/tiendas/{tienda}/editar', 'TiendaController@editarTienda');
Route::post('/admin/tiendas/{tienda}/guardar', 'TiendaController@guardarTienda');
Route::get('/admin/tiendas/{tienda}/eliminar', 'TiendaController@eliminarTienda');
Route::get('/admin/tienda/crear', 'TiendaController@indexCrearTienda');
Route::post('/admin/tienda/crear/validar', 'TiendaController@crearTienda');
