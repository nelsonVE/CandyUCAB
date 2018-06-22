<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function getIndex(Request $request){
      if($request->session()->has('userid') && $request->session()->has('rol')){
        if($request->session()->get('rol') < 1)
          return redirect('/panel');

        return \View::make('admin.index', [
          'usuario' => $request->session()->has('username'),
          'userid' => $request->session()->has('userid'),
          'rol' => $request->session()->has('rol')
        ]);
      }
      return redirect('/');
    }
}
