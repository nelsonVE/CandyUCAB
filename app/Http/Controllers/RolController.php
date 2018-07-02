<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RolController extends Controller
{
  public function verRoles($estado = 0, Request $request){
    if($request->session()->has('userid') && $request->session()->has('rol')){
      if(!checkPermiso($request->session()->get('rol'), 2))
        return redirect('/panel');

      $roles = \DB::table('rol')->get();

      return \View::make('admin.roles.ver', [
        'usuario' => $request->session()->get('username'),
        'userid' => $request->session()->get('userid'),
        'rol' => $request->session()->get('rol'),
        'roles' => $roles,
        'estado' => $estado
      ]);
    }
    return redirect('/');
  }

  public function editarRol($rol_id, Request $request){
    if($request->session()->has('userid') && $request->session()->has('rol')){
      if(!checkPermiso($request->session()->get('rol'), 2))
        return redirect('/panel');

      if(!checkPermiso($request->session()->get('rol'), 9))
        return redirect('/admin/usuarios/-4');

      $rola = \DB::table('rol')->where('id_rol', $rol_id)->first();

      if(!$rola)
        return redirect('/admin/roles/-3');

      $rol_pers = \DB::table('rol_per')->select('fk_per')->where('fk_rol', $rol_id)->get();
      $permisos = \DB::table('permiso')->get();

      return \View::make('admin.roles.editar', [
        'usuario_' => $request->session()->get('username'),
        'userid' => $request->session()->get('userid'),
        'rol' => $request->session()->get('rol'),
        'rola' => $rola,
        'rol_pers' => $rol_pers,
        'permisos' => $permisos
      ]);
    }
    return redirect('/');
  }

  public function guardarRol($rol_id, Request $request){
    if($request->session()->has('userid') && $request->session()->has('rol')){
      if(!checkPermiso($request->session()->get('rol'), 2))
        return redirect('/panel');

      $this->validate($request, [
        'tipo' => 'between:3,128'
      ]);

      for($permiso = 1; $permiso < 11; $permiso++){
        $var = 'p'.$permiso;

        $consulta = \DB::table('rol_per')->where([
          ['fk_rol', '=', $rol_id],
          ['fk_per', '=', $permiso]
        ])->count();

        if(!$consulta && $request->{$var}){
          \DB::table('rol_per')->insert([
            'fk_per' => $request->{$var},
            'fk_rol' => $rol_id
          ]);
        } else if($consulta && !$request->{$var}) {
          \DB::table('rol_per')->where([
            ['fk_per', '=', $permiso],
            ['fk_rol', '=', $rol_id]
          ])->delete();
        }
      }

      \DB::table('rol')->where('id_rol', $rol_id)->update([
          'tipo' => $request->tipo
        ]
      );

      return redirect('/admin/roles/1');
    }
    return redirect('/');
  }
}
