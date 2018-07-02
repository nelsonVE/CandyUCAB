<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function getIndex(Request $request){
      if($request->session()->has('userid') && $request->session()->has('rol')){
        if(!checkPermiso($request->session()->get('rol'), 2))
          return redirect('/panel');

        return \View::make('admin.index', [
          'usuario' => $request->session()->get('username'),
          'userid' => $request->session()->get('userid'),
          'rol' => $request->session()->get('rol')
        ]);
      }
      return redirect('/');
    }

    public function notificaciones(Request $request){
      if($request->session()->has('userid') && $request->session()->has('rol')){
        if(!checkPermiso($request->session()->get('rol'), 2))
          return redirect('/panel');

        return \View::make('admin.notificaciones', [
          'usuario' => $request->session()->get('username'),
          'userid' => $request->session()->get('userid'),
          'rol' => $request->session()->get('rol')
        ]);
      }
      return redirect('/');
    }

    public function makeInventario(Request $request){
      if($request->session()->has('userid') && $request->session()->has('rol')){
        if(!checkPermiso($request->session()->get('rol'), 2))
          return redirect('/panel');

        $usuario = \DB::table('usuario')->select('fk_per')->where('id_usu', $request->session()->get('userid'))->first()->fk_per;
        $tienda = \DB::table('personal')->select('fk_tie')->where('id_per', $usuario)->first()->fk_tie;
        $pasillos = \DB::table('pasillo')->where('fk_tie', $tienda)->get();
        foreach($pasillos as $pasillo){
          $zonas = \DB::table('zona')->where('fk_pas', $pasillo->id_pas)->get();
          foreach($zonas as $zona){
            $zoncar = \DB::table('zon_car')->select('cantidad_zca')->where('fk_zon', $zona->id_zon)->orderby('fecha_zca', 'desc')->first();
            if($zoncar){
              if($zoncar->cantidad_zca <= 100){
                $faltantes[] = [
                  'letra_zon' => $zona->letra_zon,
                  'cantidad' => $zoncar->cantidad_zca,
                  'tienda' => $tienda,
                  'pasillo' => $pasillo->numero_pas
                ];
              }
            }
          }
        }
        if(!isset($faltantes))
          $faltantes = null;
        return \View::make('admin.inventario', [
          'usuario' => $request->session()->get('username'),
          'userid' => $request->session()->get('userid'),
          'rol' => $request->session()->get('rol'),
          'productos' => $faltantes
        ]);
      }
      return redirect('/');
    }

    public function reponerInventario($tienda, Request $request){
      if($request->session()->has('userid') && $request->session()->has('rol')){
        if(!checkPermiso($request->session()->get('rol'), 2))
          return redirect('/panel');

        $pasillos = \DB::table('pasillo')->where('fk_tie', $tienda)->get();

        foreach($pasillos as $pasillo){
          $zonas = \DB::table('zona')->where('fk_pas', $pasillo->id_pas)->get();
          foreach($zonas as $zona){
            $zoncar = \DB::table('zon_car')->select(['cantidad_zca', 'fk_car'])->where('fk_zon', $zona->id_zon)->orderby('fecha_zca')->first();
            $fecha = date('Y-m-d H:i:s');
            if($zoncar){
              if($zoncar->cantidad_zca <= 100){
                \DB::table('zon_car')->insert([
                  [
                    'fecha_zca' => $fecha,
                    'cantidad_zca' => ($zoncar->cantidad_zca)+10000,
                    'fk_zon' => $zona->id_zon,
                    'fk_car' => $zoncar->fk_car
                  ]
                ]);
              }
            }
          }
        }

        return redirect('/admin/hacerinv');
      }
      return redirect('/');
    }
}
