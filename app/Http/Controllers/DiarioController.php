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

  public function emitirDiario(Request $request){
    if($request->session()->has('userid') && $request->session()->has('rol')){
      if(!checkPermiso($request->session()->get('rol'), 2))
        return redirect('/panel');

      if(!checkPermiso($request->session()->get('rol'), 4))
        return redirect('/admin/diario/oferta/-4');

      $fecha_actual = date('Y-m-d');
      $fk_per = \DB::table('usuario')->select('fk_per')->where('id_usu', $request->session()->get('userid'))->get();

      \DB::table('diario')->insert([
        'fecha_emision_dia' => $fecha_actual,
        'fk_per' => $fk_per[0]->fk_per
      ]);
      return redirect('/admin/diario/ofertas/3');
    }
    return redirect('/');
  }

  public function verDiario(Request $request){
    if($request->session()->has('userid') && $request->session()->has('rol')){
      if(!checkPermiso($request->session()->get('rol'), 1))
        return redirect('/');

      $fecha_actual = date('Y-m-d');
      $diario = \DB::table('diario')->orderBy('fecha_emision_dia', 'desc')->first();
      $ofe_car = \DB::table('ofe_car')->get();
      $ofe_inf = \DB::table('oferta')
                      ->whereDate('fecha_ini_ofe', '<=', $fecha_actual)
                      ->whereDate('fecha_fin_ofe', '>=', $fecha_actual)
                      ->get();
      $caramelos = \DB::table('caramelo')->get();

      if(!$diario)
        $diario = 0;

      return \View::make('panel.diario', [
        'usuario' => $request->session()->get('username'),
        'userid' => $request->session()->get('userid'),
        'rol' => $request->session()->get('rol'),
        'diario' => $diario,
        'ofe_car' => $ofe_car,
        'ofe_inf' => $ofe_inf,
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
      $existe_oferta = \DB::table('oferta')->select('id_ofe')->whereDate('fecha_ini_ofe', $fecha_ini)->first();
      $fk_per = \DB::table('usuario')->select('fk_per')->where('id_usu', $request->session()->get('userid'))->get();

      if(!$existe_oferta){
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
      } else {
        \DB::table('ofe_car')->insert([
          'fk_ofe' => $existe_oferta->id_ofe,
          'fk_car' => $request->caramelo,
          'descuento_ofe' => $request->descuento
        ]);
      }



      return redirect('/admin/diario/ofertas/1');
    }
    return redirect('/');
  }
}
