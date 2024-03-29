<?php

// Retorna la página principal
Route::get('/', function () {
    return view('index');
});

// Registro de usuarios
Route::post('registro/crear', 'UserController@crear');
Route::get('registro/juridico', 'UserController@juridico');
Route::get('registro/natural', 'UserController@natural');
Route::resource('registro', 'UserController');

// Routes del login
Route::get('login', 'UserController@login');
Route::post('login/verificar', 'UserController@autentificar');

// Herramientas necesarias
Route::get('estado/{estado}/municipios', 'EstadoController@getMunicipios');
Route::get('municipio/{municipio}/parroquias', 'EstadoController@getParroquias');

// Panel principal del usuario
Route::get('/panel', 'PanelController@getIndex');
Route::get('/panel/configuracion', 'PanelController@getConfig');
Route::post('/panel/configuracion/guardar', 'PanelController@guardarConfig');
Route::get('/panel/salir', 'PanelController@logout');

// Panel principal de la tienda online
Route::get('/panel/tienda', 'TiendaController@getIndex');
Route::get('/panel/tienda/candy', 'TiendaController@getShop');
Route::post('/panel/tienda/sitio', 'TiendaController@setSitio');
Route::get('/panel/tienda/candy/agregar/{id_car}', 'TiendaController@addCarrito');
Route::post('/panel/tienda/candy/procesar', 'TiendaController@procesarArticulo');
Route::get('/panel/tienda/carrito', 'TiendaController@verCarrito');
Route::post('/panel/tienda/candy/carrito/procesar', 'TiendaController@procesarCarrito');
Route::get('/panel/tienda/candy/carrito/presupuesto', 'TiendaController@hacerPresupuesto');
Route::get('/panel/tienda/candy/carrito/presupuesto/ok', 'TiendaController@finPresupuesto');
Route::get('/panel/tienda/candy/error/{error}', 'TiendaController@indexError');
Route::get('/panel/tienda/candy/carrito/tipopago', 'TiendaController@seleccionarMetodo');

// Panel - Misceláneo
Route::get('/panel/diario', 'DiarioController@verDiario');

// Información de la página
Route::get('/productos', 'ProductoController@getIndex');

// Importadora de excel
Route::get('/importar/excel', 'ExcelController@importarExcel');

// Administración
Route::get('/admin', 'AdminController@getIndex');
Route::get('/admin/notificaciones', 'AdminController@notificaciones');
Route::get('/admin/hacerinv', 'AdminController@makeInventario');
Route::get('/admin/reponer/{tienda}', 'AdminController@reponerInventario');

// Administración - Tiendas
Route::get('/admin/tiendas/{estado?}', 'TiendaController@verTiendas');
Route::get('/admin/tiendas/{tienda}/editar', 'TiendaController@editarTienda');
Route::post('/admin/tiendas/{tienda}/guardar', 'TiendaController@guardarTienda');
Route::get('/admin/tiendas/{tienda}/eliminar', 'TiendaController@eliminarTienda');
Route::get('/admin/tienda/crear', 'TiendaController@indexCrearTienda');
Route::post('/admin/tienda/crear/validar', 'TiendaController@crearTienda');

// Administración - Productos
Route::get('/admin/productos/{estado?}', 'ProductoController@verProductos');
Route::get('/admin/productos/{producto}/editar', 'ProductoController@editarProducto');
Route::post('/admin/productos/{producto}/guardar', 'ProductoController@guardarProducto');
Route::get('/admin/productos/{producto}/eliminar', 'ProductoController@eliminarProducto');

// Administración - Clientes
Route::get('/admin/clientes/{estado?}', 'ClienteController@verClientes');
Route::get('/admin/clientes/{cliente}/eliminar', 'ClienteController@eliminarCliente');
Route::get('/admin/clientes/{cliente}/editar', 'ClienteController@editarCliente');
Route::post('/admin/clientes/{cliente}/guardar', 'ClienteController@guardarCliente');

// Administración - Usuarios
Route::get('/admin/usuarios/{estado?}', 'UsuarioController@verUsuarios');
Route::get('/admin/usuarios/{usuario}/editar', 'UsuarioController@editarUsuario');
Route::post('/admin/usuarios/{usuario}/guardar', 'UsuarioController@guardarUsuario');
Route::get('/admin/usuarios/{usuario}/eliminar', 'UsuarioController@eliminarUsuario');
Route::get('/admin/usuario/crear', 'UsuarioController@IndexCrearUsuario');
Route::post('/admin/usuario/crear/validar', 'UsuarioController@crearUsuario');

// Administración - Roles
Route::get('/admin/roles/{estado?}', 'RolController@verRoles');
Route::get('/admin/roles/{rol}/editar', 'RolController@editarRol');
Route::post('/admin/roles/{rol}/guardar', 'RolController@guardarRol');

// Administración - Diario Dulce
Route::get('/admin/diario/ofertas/{estado?}', 'DiarioController@verOfertas');
Route::get('/admin/diario/oferta/crear', 'DiarioController@indexCrearOferta');
Route::post('/admin/diario/oferta/validar', 'DiarioController@crearOferta');
Route::get('/admin/diario/forzar', 'DiarioController@emitirDiario');
