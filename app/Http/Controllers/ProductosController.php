<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductosController extends Controller
{
    public function getIndex(Request $request){
      $productos = \DB::table('caramelo')->get();
      if($request->session()->has('userid')){
        return \View::make('panel.productos', [
          'productos' => $productos,
          'usuario'   => $request->session()->get('username')
        ]);
      } else {
        return \View::make('home.productos', [
          'productos' => $productos
        ]);
      }
    }
}
