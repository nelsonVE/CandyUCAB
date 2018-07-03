<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PanelController extends Controller
{
    public function getIndex(Request $request){
      if($request->session()->has('userid')){
        return \View::make('panel.inicio', [
          'usuario' => $request->session()->get('username'),
          'userid'  => $request->session()->get('userid'),
          'rol' => $request->session()->get('rol')
        ]);
      }
      return redirect('/');
    }

    public function getConfig(Request $request){
      if($request->session()->has('userid')){
        return \View::make('panel.configuracion', [
          'usuario' => $request->session()->get('username'),
          'userid'  => $request->session()->get('userid'),
          'rol' => $request->session()->get('rol')
        ]);
      }
      return redirect('/');
    }

    public function guardarConfig(Request $request){
      if($request->session()->has('userid')){

        $this->validate($request, [
          'digitos'=> 'digits_between:3,3',
          'numero' => 'digits_between:16,16'
        ]);

        $fk_cli = \DB::table('usuario')->select('fk_cli')->where('id_usu', $request->session()->get('userid'))->first();

        if(!$fk_cli)
          return dd('fk_cli devolvió NULL (¿Estás comprando siendo empleado?)');

        \DB::table('pago')->insert([
          'tipo' => 1,
          'nro_tarjeta_cre' => $request->numero,
          'tipo_cre' => $request->tipo_cre,
          'fecha_venc_cre' => $request->mes_venc.'/'.$request->anho_venc,
          'fk_cli' => $fk_cli->fk_cli
        ]);

        return redirect('/panel/configuracion');
      }
      return redirect('/');
    }

    public function logout(Request $request){
      if($request->session()->has('userid') || $request->session()->has('username'))
        $request->session()->flush();

      return redirect('/');
    }
}
