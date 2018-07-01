<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsuarioController extends Controller
{
  public function verUsuarios($estado = 0, Request $request){
    if($request->session()->has('userid') && $request->session()->has('rol')){
      if($request->session()->get('rol') < 1)
        return redirect('/panel');

      $usuarios = \DB::table('usuario')->get();

      return \View::make('admin.usuarios.ver', [
        'usuario' => $request->session()->get('username'),
        'userid' => $request->session()->get('userid'),
        'rol' => $request->session()->get('rol'),
        'usuarios' => $usuarios,
        'estado' => $estado
      ]);
    }
    return redirect('/');
  }

  public function editarUsuario($usuario_id, Request $request){
    if($request->session()->has('userid') && $request->session()->has('rol')){
      if($request->session()->get('rol') < 1)
        return redirect('/panel');

      if($request->session()->get('rol') < 9)
        return redirect('/admin/usuarios/-4');

      $usuario = \DB::table('usuario')->where('id_usu', $usuario_id)->first();
      $roles = \DB::table('rol')->get();
      if(!$usuario)
        return redirect('/admin/usuarios/-3');

      return \View::make('admin.usuarios.editar', [
        'usuario_' => $request->session()->get('username'),
        'userid' => $request->session()->get('userid'),
        'rol' => $request->session()->get('rol'),
        'usuario' => $usuario,
        'roles' => $roles
      ]);
    }
    return redirect('/');
  }

  public function guardarUsuario($usuario_id, Request $request){
    if($request->session()->has('userid') && $request->session()->has('rol')){
      if($request->session()->get('rol') < 1)
        return redirect('/panel');

      $this->validate($request, [
        'usuario' => 'between:6,30'
      ]);

      \DB::table('usuario')->where('id_usu', $usuario_id)->update([
          'usuario' => $request->usuario,
          'fk_rol' => $request->rol
        ]
      );
      return redirect('/admin/usuarios/1');
    }
    return redirect('/');
  }

  public function eliminarUsuario($usuario_id, Request $request){
    if($request->session()->has('userid') && $request->session()->has('rol')){
      if($request->session()->get('rol') < 1)
        return redirect('/panel');

      if($request->session()->get('rol') < 9)
        return redirect('/admin/usuarios/-4');

      if(\DB::table('usuario')->where('id_usu', $usuario_id)->delete())
        return redirect('/admin/usuarios/2');

      return redirect('/admin/usuarios/-2');
    }
    return redirect('/');
  }

  public function indexCrearUsuario(Request $request){
    if($request->session()->has('userid') && $request->session()->has('rol')){
      if($request->session()->get('rol') < 1)
        return redirect('/panel');

      if($request->session()->get('rol') < 9)
        return redirect('/admin/usuarios/-4');

      $roles = \DB::table('rol')->get();

      return \View::make('admin.usuarios.crear', [
        'usuario_' => $request->session()->get('username'),
        'userid' => $request->session()->get('userid'),
        'rol' => $request->session()->get('rol'),
        'roles' => $roles
      ]);
    }
    return redirect('/');
  }

  public function crearUsuario(Request $request){
    if($request->session()->has('userid') && $request->session()->has('rol')){
      if($request->session()->get('rol') < 1)
        return redirect('/panel');

      $this->validate($request, [
        'nombre' => 'between:6,18',
        'password' => 'between:7,29',
        'rif' => 'nullable|between:7,10',
        'cedula' => 'nullable|between:7,10'
      ]);

      $error_usuario = \Illuminate\Validation\ValidationException::withMessages([
         'nombre' => ['El usuario ya existe en el sistema']
      ]);

      $error_dato = \Illuminate\Validation\ValidationException::withMessages([
         'cedula' => ['No se ha encontrado ningún cliente/personal con los datos aportados']
      ]);

      $usuario = \DB::table('usuario')->where('usuario', $request->nombre)->count();
      if($request->radiosUsuario == 1)
        $cedula = \DB::table('cliente')->where('rif_cli', $request->rif)->count();
      else
        $cedula = \DB::table('personal')->where('cedula_per', $request->cedula)->count();

      if($usuario)
        throw $error_usuario;

      if(!$cedula)
        throw $error_dato;

      if($request->radiosUsuario == 1){
        $fk_cli = \DB::table('cliente')->select('id_cli')->where('rif_cli', $request->rif)->first()->id_cli;
        \DB::table('usuario')->insert([
          'usuario' => $request->nombre,
          'contrasenha' => $request->password,
          'fk_cli' => $fk_cli
        ]);
      } else {

        $fk_per = \DB::table('personal')->select('id_per')->where('cedula_per', $request->cedula)->first()->id_per;

        \DB::table('usuario')->insert([
          'usuario' => $request->nombre,
          'contrasenha' => $request->password,
          'fk_per' => $fk_per
        ]);
      }

      return redirect('/admin/usuarios/1');
    }
    return redirect('/');
  }
}
