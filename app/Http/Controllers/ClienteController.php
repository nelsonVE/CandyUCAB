<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClienteController extends Controller
{
  public function verClientes($estado = 0, Request $request){
    if($request->session()->has('userid') && $request->session()->has('rol')){
      if(!checkPermiso($request->session()->get('rol'), 2))
        return redirect('/panel');

      $clientes = \DB::table('cliente')->get();

      return \View::make('admin.clientes.ver', [
        'usuario' => $request->session()->get('username'),
        'userid' => $request->session()->get('userid'),
        'rol' => $request->session()->get('rol'),
        'clientes' => $clientes,
        'estado' => $estado
      ]);
    }
    return redirect('/');
  }

  public function eliminarCliente($cliente_id, Request $request){
    if($request->session()->has('userid') && $request->session()->has('rol')){
      if(!checkPermiso($request->session()->get('rol'), 2))
        return redirect('/panel');

      \DB::table('telefono')->where('fk_cli', $cliente_id)->delete();
      \DB::table('lug_jur')->where('fk_cli', $cliente_id)->delete();
      \DB::table('punto')->where('fk_cli', $cliente_id)->delete();
      \DB::table('usuario')->where('fk_cli', $cliente_id)->delete();
      \DB::table('presupuesto')->where('fk_cli', $cliente_id)->delete();
      \DB::table('pedido')->where('fk_cli', $cliente_id)->delete();
      \DB::table('pago')->where('fk_cli', $cliente_id)->delete();

      if(\DB::table('cliente')->where('id_cli', $cliente_id)->delete())
        return redirect('/admin/clientes/2');

      return redirect('/admin/clientes/-2');
    }
    return redirect('/');
  }

  public function editarCliente($cliente_id, Request $request){
    if($request->session()->has('userid') && $request->session()->has('rol')){
      if(!checkPermiso($request->session()->get('rol'), 2))
        return redirect('/panel');
      $lugar = \DB::table('lugar')->get();
      $cliente = \DB::table('cliente')->where('id_cli', $cliente_id)->first();

      if(!$cliente)
        return redirect('/admin/clientes/-3');

      return \View::make('admin.clientes.editar', [
        'usuario' => $request->session()->get('username'),
        'userid' => $request->session()->get('userid'),
        'rol' => $request->session()->get('rol'),
        'cliente' => $cliente,
        'lugar' => $lugar
      ]);
    }
    return redirect('/');
  }

  public function guardarCliente($cliente_id, Request $request){
    if($request->session()->has('userid') && $request->session()->has('rol')){
      if(!checkPermiso($request->session()->get('rol'), 2))
        return redirect('/panel');

      $cliente = \DB::table('cliente')->select('tipo')->where('id_cli', $cliente_id)->get();

      if(!$cliente)
        return redirect('/admin/clientes/-1');

      if($cliente[0]->tipo == 1){
        $this->validate($request, [
          'rif' => 'between:6,10',
          'email' => 'between:10,50',
          'denominacion_comercial' => 'between:10,100',
          'razon_social' => 'between:10,100',
          'capital'=> 'between:0,99999999.99',
          'web'  => 'between:7,64',
          'telefono'=> 'digits_between:6,11'
        ]);

        \DB::table('cliente')->where('id_cli', $cliente_id)->update([
          'rif_cli' => $request->rif,
          'correo_cli' => $request->email,
          'den_com_jur' => $request->denominacion_comercial,
          'raz_soc_jur' => $request->razon_social,
          'capital_jur' => $request->capital,
          'pag_web_jur' => $request->web,
        ]);

      } else {
        $this->validate($request, [
          'rif' => 'between:6,10',
          'email' => 'between:10,50',
          'primer_nombre' => 'between:4,10',
          'segundo_nombre' => 'between:4,10',
          'primer_apellido' => 'between:4,10',
          'segundo_apellido' => 'between:4,10',
          'cedula'=> 'integer|min:0|max:99999999',
          'telefono'=> 'digits_between:6,11'
        ]);

        \DB::table('cliente')->where('id_cli', $cliente_id)->update([
          'rif_cli' => $request->rif,
          'correo_cli' => $request->email,
          'cedula_nat' => $request->nacionalidad.''.$request->cedula,
          'nombre_1_nat' => $request->primer_nombre,
          'nombre_2_nat' => $request->segundo_nombre,
          'apellido_1_nat' => $request->primer_apellido,
          'apellido_2_nat' => $request->segundo_apellido
        ]);
      }

      return redirect('/admin/clientes/1');
    }
    return redirect('/');
  }
}
