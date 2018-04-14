<?php
class usuarioController extends Controller{

  public function __construct($method = ACCION_POR_DEFECTO){
    parent::__construct($method);
  }

  public function regjuridico(){
    echo $this->twig->render('registro/juridico.twig');
  }

  public function regnatural(){
    echo $this->twig->render('registro/natural.twig');
  }

}
?>
