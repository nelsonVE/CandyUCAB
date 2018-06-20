<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EstadoController extends Controller
{
    public function getMunicipios($estado){
      $id_estado = \DB::table('lugar')->select('id_lug')->where('nombre_lug', $estado)->get();
      return \DB::table('lugar')->select('nombre_lug', 'id_lug')->where('fk_lug', $id_estado[0]->id_lug)->get();
    }

    public function getParroquias($municipio){
      $id_municipio = \DB::table('lugar')->select('id_lug')->where('nombre_lug', $municipio)->get();
      return \DB::table('lugar')->select('nombre_lug', 'id_lug')->where('fk_lug', $id_municipio[0]->id_lug)->get();
    }
}
