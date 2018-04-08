<?php
require_once './app/config/defines.php';
require_once './app/kernel/Http/Http.php';

//use Symfony\Component\Debug\ExceptionHandler;
use Symfony\Component\Yaml\Yaml;

/*ExceptionHandler::register();

if (version_compare(phpversion(), '7.0.0', '<')) {
  throw new \RuntimeException('Se requiere al menos la versión 7.0.0 de PHP. Versión actual: '.phpversion());
}*/

function getConfig(){
  return Yaml::parseFile('./app/config/config.yml');
}
?>
