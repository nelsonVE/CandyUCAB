<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TiendaController extends Controller
{
    public function getIndex(Request $request){
      if($request->session()->has('userid')){

        if($request->session()->has('id_tie'))
          return redirect('/panel/tienda/candy');

        $tiendas = \DB::table('tienda')->get();
        return \View::make('panel.tienda', [
          'usuario' => $request->session()->get('username'),
          'rol' => $request->session()->get('rol'),
          'tiendas' => $tiendas
        ]);
      }
      return redirect('/');
    }

    public function getShop(Request $request){
      if($request->session()->has('userid')){

        if(!$request->session()->has('id_tie'))
          return redirect('/panel/tienda');


        $pasillos = \DB::table('pasillo')->where('fk_tie', $request->session()->get('id_tie'))->get();
        foreach($pasillos as $pasillo){
          $zonas = \DB::table('zona')->where('fk_pas', $pasillo->id_pas)->get();
          foreach($zonas as $zona){
            $zoncar = \DB::table('zon_car')->where('fk_zon', $zona->id_zon)->orderby('fecha_zca', 'desc')->first();

            if($zoncar->cantidad_zca > 0){
              $disponibles[] = [
                'letra_zon' => $zona->letra_zon,
                'cantidad' => $zoncar->cantidad_zca,
                'tienda' => $request->session()->get('id_tie'),
                'fk_car' => $zoncar->fk_car
              ];
            }
          }
        }

        if(!isset($disponibles))
          $disponibles = null;

        $productos = \DB::table('caramelo')->get();
        return \View::make('tienda.productos', [
          'usuario' => $request->session()->get('username'),
          'rol' => $request->session()->get('rol'),
          'productos' => $productos,
          'disponibles' => $disponibles
        ]);
      }
      return redirect('/');
    }

    public function addCarrito($id_car, Request $request){
      if($request->session()->has('userid')){

        if(!$request->session()->has('id_tie'))
          return redirect('/panel/tienda');

        $productos = \DB::table('caramelo')->get();
        return \View::make('tienda.preagregar', [
          'usuario' => $request->session()->get('username'),
          'rol' => $request->session()->get('rol'),
          'productos' => $productos,
          'id_car' => $id_car
        ]);
      }
      return redirect('/');
    }

    public function setSitio(Request $request){
      if($request->session()->has('userid')){
        $request->session()->put('id_tie', $request->sel_tienda);
        return redirect('/panel/tienda/candy');
      }
      return redirect('/');
    }

    public function indexCrearTienda(Request $request){
      if($request->session()->has('userid') && $request->session()->has('rol')){
        if(!checkPermiso($request->session()->get('rol'), 2))
          return redirect('/panel');

        $lugar = \DB::table('lugar')->get();

        return \View::make('admin.tiendas.crear', [
          'usuario' => $request->session()->get('username'),
          'userid' => $request->session()->get('userid'),
          'rol' => $request->session()->get('rol'),
          'lugar' => $lugar
        ]);
      }
      return redirect('/');
    }

    public function crearTienda(Request $request){
      if($request->session()->has('userid') && $request->session()->has('rol')){
        if(!checkPermiso($request->session()->get('rol'), 2))
          return redirect('/panel');

        $this->validate($request, [
          'nombre' => 'required|between:7,63'
        ]);

        $tipo_tie = $request->sel_tipo;
        $nombre = $request->nombre;
        $fk_lug = isset($request->sel_parroquia) ? $request->sel_parroquia : \DB::table('lugar')->select('id_lug')->where('nombre_lug', $request->sel_municipio_prin)->where('tipo_lug', 'Municipio')->first()->id_lug;

        \DB::table('tienda')->insert([
          [
            'nombre_tie' => $nombre,
            'fk_lug' => $fk_lug,
            'tipo_tie' => $tipo_tie
          ]
        ]);

        return redirect('/admin/tiendas/1');
      }
      return redirect('/');
    }

    public function verTiendas($estado = 0, Request $request){
      if($request->session()->has('userid') && $request->session()->has('rol')){
        if(!checkPermiso($request->session()->get('rol'), 2))
          return redirect('/panel');

        $tiendas = \DB::table('tienda')->get();

        return \View::make('admin.tiendas.ver', [
          'usuario' => $request->session()->get('username'),
          'userid' => $request->session()->get('userid'),
          'rol' => $request->session()->get('rol'),
          'tiendas' => $tiendas,
          'estado' => $estado
        ]);
      }
      return redirect('/');
    }

    public function editarTienda($tienda_id, Request $request){
      if($request->session()->has('userid') && $request->session()->has('rol')){
        if(!checkPermiso($request->session()->get('rol'), 2))
          return redirect('/panel');

        $tienda = \DB::table('tienda')->where('id_tie', $tienda_id)->first();

        if(!$tienda)
          return redirect('/admin/tiendas/-3');

        return \View::make('admin.tiendas.editar', [
          'usuario' => $request->session()->get('username'),
          'userid' => $request->session()->get('userid'),
          'rol' => $request->session()->get('rol'),
          'tienda' => $tienda
        ]);
      }
      return redirect('/');
    }

    public function guardarTienda($tienda_id, Request $request){
      if($request->session()->has('userid') && $request->session()->has('rol')){
        if(!checkPermiso($request->session()->get('rol'), 2))
          return redirect('/panel');

        \DB::table('tienda')->where('id_tie', $tienda_id)->update(['nombre_tie' => $request->nombre]);
        return redirect('/admin/tiendas/1');
      }
      return redirect('/');
    }

    public function eliminarTienda($tienda_id, Request $request){
      if($request->session()->has('userid') && $request->session()->has('rol')){
        if(!checkPermiso($request->session()->get('rol'), 2))
          return redirect('/panel');
        $empleados = \DB::table('personal')->where('fk_tie', $tienda_id)->get();
        foreach($empleados as $empleado){
          \DB::table('usuario')->where('fk_per', $empleado->id_per)->delete();
        }
        \DB::table('personal')->where('fk_tie', $tienda_id)->delete();

        $pasillos = \DB::table('pasillo')->where('fk_tie', $tienda_id)->get();
        foreach($pasillos as $pasillo){
          $zonas = \DB::table('zona')->where('fk_pas', $pasillo->id_pas)->get();
          foreach($zonas as $zona){
            \DB::table('zon_car')->where('fk_zon', $zona->id_zon)->delete();
          }
          \DB::table('zona')->where('fk_pas', $pasillo->id_pas)->delete();
        }

        \DB::table('pasillo')->where('fk_tie', $tienda_id)->delete();

        \DB::table('departamento')->where('fk_tie', $tienda_id)->delete();

        if(\DB::table('tienda')->where('id_tie', $tienda_id)->delete())
          return redirect('/admin/tiendas/2');

        return redirect('/admin/tiendas/-2');
      }
      return redirect('/');
    }
}
