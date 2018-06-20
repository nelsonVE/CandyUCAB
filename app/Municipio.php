<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    public function estado(){
      return $this->belongsTo('App\Estado');
    }
    public function parroquias(){
      return $this->hasMany('App\Parroquia');
    }
}
