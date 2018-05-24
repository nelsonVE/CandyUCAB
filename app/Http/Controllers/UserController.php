<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class UserController extends Controller
{
    public function show($id){

    }

    public function juridico(){
      return \View::make('registro.juridico');
    }

    public function crear(Request $request){
      $this->validate($request, [
        'password' => 'required|digits_between:6,18|confirmed',
        'password_confirmation' => 'required|digits_between:6,18',
      ]);

      //dd($request->all());

      if($request->_tipo == 1){
        $usuario = $request->usuario;
        $password = $request->password;
        $rif = $request->rif;
        $dir_fiscal = $request->direccion_fiscal;
        $dir_fisica = $request->direccion_fisica;
        $den_comercial = $request->denominacion_comercial;
        $email = $request->email;
        $razon_social = $request->razon_social;
        $web = $request->web;
        $verificar = \DB::table('cliente')->select('rif_cli')->where('rif_cli', $rif)->count();

        if($verificar > 0){
          return 'Usuario ya existe';
        }

        \DB::table('usuario')->insert([
          ['usuario' => $usuario,
          'password' => $password,
          'fk_cliente' => $rif]
        ]);

        \DB::table('cliente')->insert([
          ['rif_cli' => $rif,
           'correo_cli' => $email,
           'tipo_cli' => 1,
           'den_com_jur' => $den_comercial,
           'razon_soc_jur' => $razon_social,
           'pag_web_jur' => $web,
           'capital_jur' => 100,
           'cedula_nat' => 'cero']
        ]);
      } else {
      }
    }

}
