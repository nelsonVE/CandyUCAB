<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PanelController extends Controller
{
    public function getIndex(Request $request){
      if($request->session()->has('userid')){
        return \View::make('panel.inicio', [
          'usuario' => $request->session()->get('username'),
          'userid'  => $request->session()->get('userid')
        ]);
      }
      return redirect('/');
    }

    public function logout(Request $request){
      if($request->session()->has('userid') || $request->session()->has('username'))
        $request->session()->flush();
        
      return redirect('/');
    }
}
