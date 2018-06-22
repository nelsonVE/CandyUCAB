<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Excel;

class ExcelController extends Controller
{

    public function importarExcel(){
      $data = Excel::load('public\xls\control.xls', function($reader){})->get();
      if(!empty($data) && $data->count()){
        //dd($data);
        foreach($data as $dato){
          $entro = explode(" ", $dato->fecha_hora_entrada);
          $salio = explode(" ", $dato->fecha_hora_salida);
          $existe = \DB::table('personal')->select('id_per')->where('cedula_per', $dato->cedula)->first()->id_per;

          if(isset($existe)){
            \DB::table('control')->insert([
              [
                'fecha_con' => $entro[0],
                'hora_ent_con' => $entro[1],
                'hora_sal_con' => $salio[1],
                'fk_per' => $existe
              ]
            ]);
          }
        }
      }
    }

}
