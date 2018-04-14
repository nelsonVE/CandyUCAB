<?php
  require_once './app/kernel/vendor/autoload.php';
  require_once './app/kernel/core.php';
  require_once './app/kernel/Controller/Controller.php';
  require_once './app/kernel/Router/Router.php';
  use ConnectionManager\Connection as Connection;
  Connection::get()->connect();
  (new Router)->ejecutarControlador();
?>
