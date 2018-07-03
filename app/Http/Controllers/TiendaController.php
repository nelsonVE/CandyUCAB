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
            if($zoncar){
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

    public function procesarArticulo(Request $request){
      if($request->session()->has('userid')){

        if(!$request->session()->has('id_tie'))
          return redirect('/panel/tienda');

        $cantidad = $request->cantidad;
        $id_car = $request->producto;
        $hay_stock = false;

        $id_tie = $request->session()->get('id_tie');
        $pasillos = \DB::table('pasillo')->where('fk_tie', $id_tie)->get();
        foreach($pasillos as $pasillo){
          $zonas = \DB::table('zona')->where('fk_pas', $pasillo->id_pas)->get();
          if($zonas){
            foreach($zonas as $zona){
              $zoncars = \DB::table('zon_car')->where('fk_zon', $zona->id_zon)->orderBy('fecha_zca', 'desc')->first();
              if($zoncars){
                if($zoncars){
                  if($zoncars->fk_car == $id_car){
                    if($zoncars->cantidad_zca >= $cantidad){
                      $hay_stock = true;
                      break;
                    }
                  }
                }
              }
            }
          }
        }

        if(!$hay_stock)
          return redirect('/panel/tienda/candy/error/1');

        $producto = [
          'id_car' => $id_car,
          'cantidad' => $cantidad
        ];

        $request->session()->push('carrito', $producto);

        return redirect('/panel/tienda/candy');
      }
      return redirect('/');
    }

    public function seleccionarMetodo(Request $request){
      if($request->session()->has('userid')){

        if(!$request->session()->has('id_tie'))
          return redirect('/panel/tienda');

        if(!$request->session()->has('carrito'))
          return redirect('/panel/tienda');

          return \View::make('panel.tipopago', [
            'usuario' => $request->session()->get('username'),
            'rol' => $request->session()->get('rol'),
            'userid' => $request->session()->get('userid')
          ]);
      }
      return redirect('/');
    }

    public function procesarCarrito(Request $request){
      if($request->session()->has('userid')){

        if(!$request->session()->has('id_tie'))
          return redirect('/panel/tienda');

        if(!$request->session()->has('carrito'))
          return redirect('/panel/tienda');

        $fecha_actual = date('Y-m-d');
        $fecha_fin = date('Y-m-d H:m:s', strtotime("+2 hour"));
        $hora_actual = date('H:m:s');
        $productos = $request->session()->get('carrito');
        $caramelos = \DB::table('caramelo')->get();
        $ofe_car = \DB::table('ofe_car')->get();
        $ofe_inf = \DB::table('oferta')
                        ->whereDate('fecha_ini_ofe', '<=', $fecha_actual)
                        ->whereDate('fecha_fin_ofe', '>=', $fecha_actual)
                        ->get();
        $precio_caramelo = 0;
        $total_pagar = 0;

        for($i = 0; $i < count($productos); $i++){
          foreach($caramelos as $caramelo){
            if($caramelo->id_car == $productos[$i]['id_car']){
              $precio_caramelo = $caramelo->precio_car;
              if($ofe_inf && $ofe_car){
                foreach($ofe_inf as $info){
                  foreach($ofe_car as $oferta){
                    if($info->id_ofe == $oferta->fk_ofe){
                      $precio_caramelo = ($oferta->descuento_ofe * $caramelo->precio_car) / 100;
                      $precio_caramelo = $caramelo->precio_car - $precio_caramelo;
                    }
                  }
                }
              }
              $total_pagar += $precio_caramelo * $productos[$i]['cantidad'];
            }
          }
        }

        $fk_cli = \DB::table('usuario')->select('fk_cli')->where('id_usu', $request->session()->get('userid'))->get();
        if(!$fk_cli[0])
          return dd('Solo los clientes pueden realizar compras, los empleados no.');

        \DB::table('pedido')->insert([
          'fk_tie' => $request->session()->get('id_tie'),
          'fk_usu' => $request->session()->get('userid'),
          'fk_cli' => $fk_cli[0]->fk_cli,
          'fecha_ped' => $fecha_actual,
          'hora_ped' => $hora_actual
        ]);

        $fk_ped = \DB::table('pedido')->select('id_ped')->orderBy('id_ped', 'desc')->first();

        if(!$fk_ped)
          return dd('ERROR: fk_ped en TiendaControl devuelve null.');

        if($request->tipopago == 1){
          $total_punto = 0;
          $puntos = \DB::table('punto')->where('fk_cli', $fk_cli[0]->fk_cli)->get();
          foreach($puntos as $punto){
            if(!$punto->fk_ped){
              $total_punto += $punto->valor_pun;
            }
          }

          if($total_punto < $total_pagar)
            return redirect('/panel/tienda/candy/error/5');

          $total_punto = 0;

          foreach($puntos as $punto){
            if(!$punto->fk_ped){
              $total_punto += $punto->valor_pun;
              \DB::table('punto')->where('id_pun', $punto->id_pun)->update(['fk_ped' => $fk_ped->id_ped]);
              if($total_punto >= $total_pagar)
                break;
            }
          }

        } else {

          for($i = 0; $i < count($productos); $i++){
            foreach($caramelos as $caramelo){
              if($caramelo->id_car == $productos[$i]['id_car']){
                \DB::table('car_ped')->insert([
                  'fk_ped' => $fk_ped->id_ped,
                  'fk_car' => $caramelo->id_car,
                  'precio_car' => $caramelo->precio_car,
                  'cantidad_car' => $productos[$i]['cantidad']
                ]);
                break;
              }
            }
          }

          $fk_pag = \DB::table('pago')->select('id_pag')->where('fk_cli', $request->session()->get('userid'))->first();
          if(!$fk_pag)
            return dd('ERROR: fk_pag retorna NULL en TiendaControl (procesarCarrito)');

          \DB::table('pag_car_ped')->insert([
            'monto_ped' => $total_pagar,
            'fk_pag' => $fk_pag->id_pag,
            'fk_ped' => $fk_ped->id_ped
          ]);

          \DB::table('ped_est')->insert([
            'fecha_ini' => $fecha_actual.' '.$hora_actual,
            'fecha_fin' => $fecha_fin,
            'fk_est' => 1,
            'fk_ped' => $fk_ped->id_ped
          ]);
        }

        $request->session()->forget('carrito');
        return redirect('/panel/tienda/candy/error/4');
      }
      return redirect('/');
    }

    public function hacerPresupuesto(Request $request){
      if($request->session()->has('userid')){

        if(!$request->session()->has('id_tie'))
          return redirect('/panel/tienda');

        if(!$request->session()->has('carrito'))
          return redirect('/panel/tienda');

        $fecha_actual = date('Y-m-d');
        $productos = $request->session()->get('carrito');
        $caramelos = \DB::table('caramelo')->get();
        $ofe_car = \DB::table('ofe_car')->get();
        $ofe_inf = \DB::table('oferta')
                        ->whereDate('fecha_ini_ofe', '<=', $fecha_actual)
                        ->whereDate('fecha_fin_ofe', '>=', $fecha_actual)
                        ->get();
        $precio_caramelo = 0;
        $total_pagar = 0;

        for($i = 0; $i < count($productos); $i++){
          foreach($caramelos as $caramelo){
            if($caramelo->id_car == $productos[$i]['id_car']){
              $precio_caramelo = $caramelo->precio_car;
              if($ofe_inf && $ofe_car){
                foreach($ofe_inf as $info){
                  foreach($ofe_car as $oferta){
                    if($info->id_ofe == $oferta->fk_ofe){
                      $precio_caramelo = ($oferta->descuento_ofe * $caramelo->precio_car) / 100;
                      $precio_caramelo = $caramelo->precio_car - $precio_caramelo;
                    }
                  }
                }
              }
              $total_pagar += $precio_caramelo * $productos[$i]['cantidad'];
            }
          }
        }

        $fk_cli = \DB::table('usuario')->select('fk_cli')->where('id_usu', $request->session()->get('userid'))->get();
        if(!$fk_cli[0])
          return dd('Solo los clientes pueden hacer presupuestos, los empleados no.');

        \DB::table('presupuesto')->insert([
          'fk_tie' => $request->session()->get('id_tie'),
          'fk_usu' => $request->session()->get('userid'),
          'fk_cli' => $fk_cli[0]->fk_cli,
          'fecha_pre' => $fecha_actual,
          'total_pre' => $total_pagar
        ]);

        $fk_pre = \DB::table('presupuesto')->select('id_pre')->orderBy('id_pre', 'desc')->first();

        if(!$fk_pre)
          return dd('ERROR: fk_pre en TiendaControl devuelve null.');

        for($i = 0; $i < count($productos); $i++){
          foreach($caramelos as $caramelo){
            if($caramelo->id_car == $productos[$i]['id_car']){
              \DB::table('pre_car')->insert([
                'fk_pre' => $fk_pre->id_pre,
                'fk_car' => $caramelo->id_car
              ]);
              break;
            }
          }
        }

        return redirect('/panel/tienda/candy/carrito/presupuesto/ok');
      }
      return redirect('/');
    }

    public function finPresupuesto(Request $request){
      if($request->session()->has('userid')){

        if(!$request->session()->has('id_tie'))
          return redirect('/panel/tienda');

        return \View::make('panel.alertapresupuesto', [
          'usuario' => $request->session()->get('username'),
          'rol' => $request->session()->get('rol'),
          'userid' => $request->session()->get('userid')
        ]);
      }
      return redirect('/');
    }

    public function indexError($error, Request $request){
      if($request->session()->has('userid')){

        if(!$request->session()->has('id_tie'))
          return redirect('/panel/tienda');

        return \View::make('panel.error', [
          'usuario' => $request->session()->get('username'),
          'rol' => $request->session()->get('rol'),
          'userid' => $request->session()->get('userid'),
          'error' => $error
        ]);
      }
      return redirect('/');
    }

    public function verCarrito(Request $request){
      if($request->session()->has('userid')){

        if(!$request->session()->has('id_tie'))
          return redirect('/panel/tienda');

        $productos = $request->session()->get('carrito');
        $caramelos = \DB::table('caramelo')->get();

        $fecha_actual = date('Y-m-d');
        $ofe_car = \DB::table('ofe_car')->get();
        $ofe_inf = \DB::table('oferta')
                        ->whereDate('fecha_ini_ofe', '<=', $fecha_actual)
                        ->whereDate('fecha_fin_ofe', '>=', $fecha_actual)
                        ->get();

        return \View::make('panel.carrito', [
          'usuario' => $request->session()->get('username'),
          'rol' => $request->session()->get('rol'),
          'userid' => $request->session()->get('userid'),
          'productos' => $productos,
          'caramelos' => $caramelos,
          'ofe_car' => $ofe_car,
          'ofe_inf' => $ofe_inf
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
