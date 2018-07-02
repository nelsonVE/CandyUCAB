<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductoController extends Controller
{
    public function getIndex(Request $request){
      $productos = \DB::table('caramelo')->get();
      if($request->session()->has('userid')){
        return \View::make('panel.productos', [
          'productos' => $productos,
          'usuario'   => $request->session()->get('username'),
          'rol' => $request->session()->get('rol')
        ]);
      } else {
        return \View::make('home.productos', [
          'productos' => $productos
        ]);
      }
    }

    public function verProductos($estado = 0, Request $request){
      if($request->session()->has('userid') && $request->session()->has('rol')){
        if(!checkPermiso($request->session()->get('rol'), 2))
          return redirect('/panel');

        $productos = \DB::table('caramelo')->get();

        return \View::make('admin.productos.ver', [
          'usuario' => $request->session()->get('username'),
          'userid' => $request->session()->get('userid'),
          'rol' => $request->session()->get('rol'),
          'productos' => $productos,
          'estado' => $estado
        ]);
      }
      return redirect('/');
    }

    public function editarProducto($producto_id, Request $request){
      if($request->session()->has('userid') && $request->session()->has('rol')){
        if(!checkPermiso($request->session()->get('rol'), 2))
          return redirect('/panel');

        $producto = \DB::table('caramelo')->where('id_car', $producto_id)->first();

        if(!$producto)
          return redirect('/admin/productos/-3');

        return \View::make('admin.productos.editar', [
          'usuario' => $request->session()->get('username'),
          'userid' => $request->session()->get('userid'),
          'rol' => $request->session()->get('rol'),
          'producto' => $producto
        ]);
      }
      return redirect('/');
    }

    public function eliminarProducto($producto_id, Request $request){
      if($request->session()->has('userid') && $request->session()->has('rol')){
        if(!checkPermiso($request->session()->get('rol'), 2))
          return redirect('/panel');

        \DB::table('zon_car')->where('fk_car', $producto_id)->delete();

        if(\DB::table('caramelo')->where('id_car', $producto_id)->delete())
          return redirect('/admin/productos/2');

        return redirect('/admin/productos/-2');
      }
      return redirect('/');
    }

    public function guardarProducto($producto_id, Request $request){
      if($request->session()->has('userid') && $request->session()->has('rol')){
        if(!checkPermiso($request->session()->get('rol'), 2))
          return redirect('/panel');

        $this->validate($request, [
          'nombre' => 'between:3,31',
          'desc'   => 'between:7,126',
          'url'    => 'between:7,257',
          'forma'  => 'between:7,31',
          'tamanho'=> 'between:5,11',
          'sabor'  => 'between:7,29',
          'precio' => 'integer|min:0'
        ]);

        \DB::table('caramelo')->where('id_car', $producto_id)->update([
            'nombre_car' => $request->nombre,
            'forma_car' => $request->forma,
            'desc_car' => $request->desc,
            'sabor_car' => $request->sabor,
            'tamanho_car' => $request->tamanho,
            'precio_car' => $request->precio,
            'url_car' => $request->url
          ]
        );
        return redirect('/admin/productos/1');
      }
      return redirect('/');
    }
}
