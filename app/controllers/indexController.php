<?php

require_once 'app/kernel/Controller/Controller.php';


class indexController extends Controller{

  public function __construct($method = ACCION_POR_DEFECTO){
    parent::__construct($method);
  }

  public function index($method = null){
    echo $this->twig->render('index/index.twig');
  }

  public function tienda(){
    echo $this->twig->render('index/tienda.twig');
  }
}

?>
