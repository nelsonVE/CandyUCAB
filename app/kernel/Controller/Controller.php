<?php



abstract class Controller{
  protected $vista;
  protected $method;
  protected $twig;

  protected function __construct($method = ACCION_POR_DEFECTO){
    $this->method = $method;

    $loader = new Twig_Loader_Filesystem('./app/resources/');
    $this->twig = new Twig_Environment($loader);
  }

  protected function index($method = null){

  }

}

?>
