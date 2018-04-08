<?php
require_once 'app/kernel/Controller/Controller.php';


class errorController extends Controller{

  public function __construct($method = ACCION_POR_DEFECTO){
    parent::__construct($method);
  }

  public function index($method = null){
    echo $this->twig->render('error/error.twig');
  }
}
?>
