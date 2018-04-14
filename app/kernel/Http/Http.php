<?php

class Http{
  public function __construct(){}

  public function getQuery(){
    $query;
    if(isset($_GET['controller'])){
      $query['controller'] = $_GET['controller'];
    } else {
      $query['controller'] = CONTROLADOR_POR_DEFECTO;
    }

    if(isset($_GET['action'])){
      $query['action'] = $_GET['action'];
    } else {
      $query['action'] = ACCION_POR_DEFECTO;
    }

    return $query;
  }
}

?>
