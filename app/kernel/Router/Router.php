<?php

class Router{

  private $controller;
  private $query;

  public function __construct(){
    $this->query = (new Http)->getQuery();
    $this->controller = $this->query['controller'];
    $config = getConfig();
  }

  public function ejecutarControlador(){
    if($this->controller != null){
      $controlador = $this->controller.'Controller';
      if(!is_readable('./app/controllers/'.$controlador.'.php')){
        $controlador = 'errorController';
      }
      require './app/controllers/'.$controlador.'.php';
    } else {
      $controlador = 'indexController';
    }

    if(method_exists($controlador, $this->query['action'])){
      $action = $this->query['action'];
      (new $controlador)->$action();
    } else {
      (new $controlador)->index();
    }
  }
}

?>
