<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductosController extends Controller
{
    public function getIndex(Request $request){
      $productos = \DB::table('caramelo')->get();
      return \View::make('panel.productos', [
        'productos' => $productos,
        'usuario'   => $request->session()->get('username')
      ]);
    }
}
