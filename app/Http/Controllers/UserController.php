<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

use App\{Estado, Municipio, Parroquia};

class UserController extends Controller
{
    public function show($id){

    }

    public function juridico(){
      $lugar = \DB::table('lugar')->get();
      return \View::make('registro.juridico', ['lugar' => $lugar]);
    }

    public function natural(){
      $lugar = \DB::table('lugar')->get();
      return \View::make('registro.natural', ['lugar' => $lugar]);
    }

    public function crear(Request $request){
    //  dd($request->all());

      if($request->_tipo == 1){
        $this->validate($request, [
          //'rif' => 'required|digits_between:7,10',
          'password' => 'required|digits_between:6,18|confirmed',
          'password_confirmation' => 'required',
          'ci_percon' => 'required|numeric',
          'capital' => 'required|numeric',
          'telefono' => 'required|numeric'
        ]);
        $usuario = $request->usuario;
        $password = $request->password;
        $rif = $request->rif;
        $dir_fiscal = isset($request->sel_parroquia) ? $request->sel_parroquia : \DB::table('lugar')->select('id_lug')->where('nombre_lug', $request->sel_municipio_prin)->where('tipo_lug', 'Municipio')->first()->id_lug;
        $dir_fisica = isset($request->sel_parroquia_prin) ? $request->sel_parroquia_prin : \DB::table('lugar')->select('id_lug')->where('nombre_lug', $request->sel_municipio_prin)->where('tipo_lug', 'Municipio')->first()->id_lug;
        $den_comercial = $request->denominacion_comercial;
        $email = $request->email;
        $razon_social = $request->razon_social;
        $web = $request->web;
        $capital = $request->capital;
        $telefono = $request->telefono;
        $cedula_per = $request->nac_percon.''.$request->ci_percon;
        $nombre_per = $request->nom_percon;
        $apellido_per = $request->ape_percon;
        $telefono_per = $request->tel_percon;
        $verificar = \DB::table('cliente')->select('rif_cli')->where('rif_cli', $rif)->count();
        $username = \DB::table('usuario')->select('id_usu')->where('usuario', $usuario)->count();
      if(($verificar+$username) > 0){
        return 'Usuario ya existe';
      }

        \DB::table('cliente')->insert([
          [
            'rif_cli' => $rif,
            'correo_cli' => $email,
            'tipo' => 1,
            'den_com_jur' => $den_comercial,
            'raz_soc_jur' => $razon_social,
            'pag_web_jur' => $web,
            'capital_jur' => $capital,
            'fk_lug' => $dir_fisica,
            'fk_lug_jur' => $dir_fiscal
          ]
        ]);

        $fk_user = \DB::table('cliente')->select('id_cli')->where('rif_cli', $rif)->first()->id_cli;

        \DB::table('usuario')->insert([
          [
            'usuario' => $usuario,
            'contrasenha' => $password,
            'fk_cli' => $fk_user
          ]
        ]);

        \DB::table('telefono')->insert([
          [
            'numero_tel' => $telefono,
            'fk_cli' => $fk_user
          ]
        ]);

        \DB::table('per_con')->insert([
          [
            'cedula_per' => $cedula_per,
            'nombre_per' => $nombre_per,
            'apellido_per' => $apellido_per,
            'fk_cli' => $fk_user]
        ]);

        $fk_pco = \DB::table('per_con')->select('id_pco')->where('cedula_per', $cedula_per)->first()->id_pco;

        \DB::table('telefono')->insert([
          [
            'numero_tel' => $telefono,
            'fk_cli' => $fk_pco
         ]
        ]);

      } else {
        $this->validate($request, [
          //'rif' => 'required|digits_between:7,10',
          'primer_nombre' => 'required|alpha',
          'segundo_nombre' => 'required|alpha',
          'primer_apellido' => 'required|alpha',
          'segundo_apellido' => 'alpha',
          'password' => 'required|digits_between:6,18|confirmed',
          'password_confirmation' => 'required',
          'cedula' => 'required|numeric',
          'telefono' => 'required|numeric'
        ]);

        $rif_cli = $request->rif;
        $primer_nombre = $request->primer_nombre;
        $segundo_nombre = $request->segundo_nombre;
        $primer_apellido = $request->primer_apellido;
        $correo = $request->email;
        $segundo_apellido = isset($request->segundo_apellido) ? $request->segundo_apellido : NULL;
        $cedula_nat = $request->nacionalidad.''.$request->cedula;
        $usuario = $request->usuario;
        $dir_habitacion = isset($request->sel_parroquia) ? $request->sel_parroquia : \DB::table('lugar')->select('id_lug')->where('nombre_lug', $request->sel_municipio_prin)->where('tipo_lug', 'Municipio')->first()->id_lug;
        $password = $request->password;
        $telefono = $request->telefono;
        $verificar = \DB::table('cliente')->select('rif_cli')->where('rif_cli', $rif_cli)->count();
        $username = \DB::table('usuario')->select('id_usu')->where('usuario', $usuario)->count();

        if(($verificar+$username) > 0){
          return 'Usuario ya existe';
        }

        \DB::table('cliente')->insert([
          [
            'rif_cli' => $rif_cli,
            'tipo' => 0,
            'correo_cli' => $correo,
            'cedula_nat' => $cedula_nat,
            'nombre_1_nat' => $primer_nombre,
            'nombre_2_nat' => $segundo_nombre,
            'apellido_1_nat' => $primer_apellido,
            'apellido_2_nat' => $segundo_apellido,
            'fk_lug' => $dir_habitacion
          ]
        ]);

        $fk_user = \DB::table('cliente')->select('id_cli')->where('rif_cli', $rif_cli)->first()->id_cli;

        \DB::table('usuario')->insert([
          [
            'usuario' => $usuario,
            'contrasenha' => $password,
            'fk_cli' => $fk_user
          ]
        ]);

        \DB::table('telefono')->insert([
          [
            'numero_tel' => $telefono,
            'fk_cli' => $fk_user
          ]
        ]);
      }
    }

}
