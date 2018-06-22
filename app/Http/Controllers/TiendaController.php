<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TiendaController extends Controller
{
    public function getIndex(Request $request){
      if($request->session()->has('userid')){

        if($request->session()->has('id_tie'))
          return redirect('/panel/tienda/candy');

        $tiendas = \DB::table('tienda')->get();
        return \View::make('panel.tienda', [
          'usuario' => $request->session()->get('username'),
          'rol' => $request->session()->get('rol'),
          'tiendas' => $tiendas
        ]);
      }
      return redirect('/');
    }

    public function getShop(Request $request){
      if($request->session()->has('userid')){

        if(!$request->session()->has('id_tie'))
          return redirect('/panel/tienda');

        $disponibles = \DB::table('inv_car')->select('fk_car')->where([
          ['fk_tie', $request->session()->get('id_tie')],
          ['cantidad_inv', '>', '0'],
        ])->get();
        $productos = \DB::table('caramelo')->get();
        return \View::make('tienda.productos', [
          'usuario' => $request->session()->get('username'),
          'rol' => $request->session()->get('rol'),
          'productos' => $productos,
          'disponibles' => $disponibles
        ]);
      }
      return redirect('/');
    }

    public function addCarrito($id_car, Request $request){
      if($request->session()->has('userid')){

        if(!$request->session()->has('id_tie'))
          return redirect('/panel/tienda');

        $productos = \DB::table('caramelo')->get();
        return \View::make('tienda.preagregar', [
          'usuario' => $request->session()->get('username'),
          'rol' => $request->session()->get('rol'),
          'productos' => $productos,
          'id_car' => $id_car
        ]);
      }
      return redirect('/');
    }

    public function setSitio(Request $request){
      if($request->session()->has('userid')){
        $request->session()->put('id_tie', $request->sel_tienda);
        return redirect('/panel/tienda/candy');
      }
      return redirect('/');
    }
}
