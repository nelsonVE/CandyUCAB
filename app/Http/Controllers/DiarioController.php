<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DiarioController extends Controller
{
  public function verOfertas($estado = 0, Request $request){
    if($request->session()->has('userid') && $request->session()->has('rol')){
      if(!checkPermiso($request->session()->get('rol'), 2))
        return redirect('/panel');

      $ofe_car = \DB::table('ofe_car')->get();
      $info_ofe = \DB::table('oferta')->get();
      $caramelos = \DB::table('caramelo')->get();

      return \View::make('admin.diario.oferta', [
        'usuario' => $request->session()->get('username'),
        'userid' => $request->session()->get('userid'),
        'rol' => $request->session()->get('rol'),
        'ofertas' => $ofe_car,
        'info_ofe' => $info_ofe,
        'caramelos' => $caramelos,
        'estado' => $estado
      ]);
    }
    return redirect('/');
  }

  public function indexCrearOferta(Request $request){
    if($request->session()->has('userid') && $request->session()->has('rol')){
      if(!checkPermiso($request->session()->get('rol'), 2))
        return redirect('/panel');

      if(!checkPermiso($request->session()->get('rol'), 4))
        return redirect('/admin/diario/oferta/-4');

      $caramelos = \DB::table('caramelo')->get();

      return \View::make('admin.diario.crear', [
        'usuario' => $request->session()->get('username'),
        'userid' => $request->session()->get('userid'),
        'rol' => $request->session()->get('rol'),
        'caramelos' => $caramelos
      ]);
    }
    return redirect('/');
  }

  public function crearOferta(Request $request){
    if($request->session()->has('userid') && $request->session()->has('rol')){
      if(!checkPermiso($request->session()->get('rol'), 2))
        return redirect('/panel');

      if(!checkPermiso($request->session()->get('rol'), 4))
        return redirect('/admin/diario/oferta/-4');

      $this->validate($request, [
        'descuento' => 'integer|min:0|max:99'
      ]);

      $fecha_ini = date('Y-m-d');
      $fecha_fin = date('Y-m-d', strtotime("+10 days"));
      $fk_per = \DB::table('usuario')->select('fk_per')->where('id_usu', $request->session()->get('userid'))->get();

      \DB::table('oferta')->insert([
        'fecha_ini_ofe' => $fecha_ini,
        'fecha_fin_ofe' => $fecha_fin,
        'fk_per' => $fk_per[0]->fk_per
      ]);

      $fk_ofe = \DB::table('oferta')->select('id_ofe')->orderBy('id_ofe', 'DESC')->first();

      \DB::table('ofe_car')->insert([
        'fk_ofe' => $fk_ofe->id_ofe,
        'fk_car' => $request->caramelo,
        'descuento_ofe' => $request->descuento
      ]);

      return redirect('/admin/diario/ofertas/1');
    }
    return redirect('/');
  }
}
