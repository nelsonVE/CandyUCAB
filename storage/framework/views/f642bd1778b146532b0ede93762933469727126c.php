<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title><?php echo $__env->yieldContent('titulo'); ?></title>
    <link rel="stylesheet" href="<?php echo asset('css/header.css'); ?>">

    <script defer src="https://use.fontawesome.com/releases/v5.0.9/js/all.js" integrity="sha384-8iPTk2s/jMVj81dnzb/iFR2sdA7u06vHJyyLlAd4snFpCl/SnyUjRrbdJsw1pGIl" crossorigin="anonymous"></script>
    <!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.5.0/css/mdb.min.css" rel="stylesheet">

    <link rel="icon"
      type="image/png"
      href="{<?php echo asset('img/favicon.ico'); ?>}">
  </head>
  <body>
    <nav class="navbar navbar-toggleable-md fixed-top navbar-expand-lg navbar-candy scrolling-navbar navbar-transparent">
      <div class="container-fluid">
        <a class="navbar-brand" href="/">
          <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/c4/Twemoji2_1f36c.svg/512px-Twemoji2_1f36c.svg.png" width="32" height="32">
          CandyUcab
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link" href="/">Inicio</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/productos">Productos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/contacto">Contáctanos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/acerca">Acerca de nostros</a>
            </li>
          </ul>
          <ul class="navbar-nav">
            <li class="nav-item mr-3">
              <a class="nav-link" href="/login">Login</span></a>
            </li>
            <li class="">
              <a class="nav-link btn-pink" href="#">Regístrate</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <?php echo $__env->yieldContent('contenido'); ?>
    <script src="<?php echo asset('js/jquery-3.3.1.slim.min.js'); ?>"></script>
    <script src="<?php echo asset('mdb/js/jquery-3.3.1.min.js'); ?>"></script>
    <!-- Bootstrap tooltips -->
    <script src="<?php echo asset('mdb/js/popper.min.js'); ?>"></script>
    <!-- Bootstrap core JavaScript -->
    <script src="<?php echo asset('mdb/js/bootstrap.min.js'); ?>"></script>
    <!-- MDB core JavaScript -->
    <script src="<?php echo asset('mdb/js/mdb.min.js'); ?>"></script>
	<!--Footer-->
<footer class="page-footer font-small footer pt-4">

	<!--Footer Links-->
	<div class="container-fluid text-center text-md-left">
	<div class="row">

	    <!--Primera columna-->
	    <div class="col-md-6">
		<h5 class="text-uppercase p-2" style="border-bottom: 1px solid rgba(255, 255, 255, 0.5); max-width: 300px;">CandyUcab</h5>
		<p class="p-2">¡Recuerda que también puedes seguirnos en nuestras redes sociales!</p>
	    </div>
	    <!--/.Primera columna-->

	    <!--Segunda columna-->
	    <div class="col-md-6">
		<h5 class="text-uppercase p-2" style="border-bottom: 1px solid rgba(255, 255, 255, 0.5); max-width: 300px;">Enlaces de ayuda:</h5>
		<ul class="list-unstyled p-2">
		    <li>
		        <a href="/tienda">Tienda</a>
		    </li>
		    <li>
		        <a href="/contacto">Contáctanos</a>
		    </li>
		    <li>
		        <a href="/acerca">Acerca de nosotros</a>
		    </li>
		</ul>
	    </div>
	    <!--/.Segunda columna-->
	</div>
	</div>
	<!--/.Footer Links-->

	<!--Copyright-->
	<div class="footer-copyright py-3 text-center">
	© 2018 - Todos los derechos reservados a sus respectivos autores.
	</div>
	<!--/.Copyright-->

	</footer>
	<!--/.Footer-->
  </body>
  <script>
  $(function(){
      var url = '<?php echo e(url('estado')); ?>/' + $(this).val() + '/municipios/';
      console.log(url);
      $.get(url, function(data) {
        var select = $('form select[name=sel_municipio]');
        select.empty();
        $.each(data, function(key, value){
          select.append('<option value="'+value.nombre_lug+'">'+value.nombre_lug+'</option>');
        });
      });
  });
  $(function(){
    $('select[name=sel_estado]').on("change", function(){
      var url = '<?php echo e(url('estado')); ?>/' + $(this).val() + '/municipios/';
      console.log(url);
      $.get(url, function(data) {
        var select = $('form select[name=sel_municipio]');
        var clean = $('form select[name=sel_parroquia]');
        select.empty();
        clean.empty();
        $.each(data, function(key, value){
          select.append('<option value="'+value.nombre_lug+'">'+value.nombre_lug+'</option>');
        });
      });
    });
  });
  $(function(){
    $('select[name=sel_municipio]').on("change", function(){
      var url = '<?php echo e(url('municipio')); ?>/' + $(this).val() + '/parroquias/';
      console.log(url);
      $.get(url, function(data) {
        var select = $('form select[name=sel_parroquia]');
        select.empty();
        $.each(data, function(key, value){
          select.append('<option value="'+value.id_lug+'">'+value.nombre_lug+'</option>');
        });
      });
    });
  });
  $(function(){
    $('select[name=sel_parroquia]').on("change", function(){

    });
  });
  $(function(){
      var url = '<?php echo e(url('estado')); ?>/' + $(this).val() + '/municipios/';
      console.log(url);
      $.get(url, function(data) {
        var select = $('form select[name=sel_municipio]');
        select.empty();
        $.each(data, function(key, value){
          select.append('<option value="'+value.nombre_lug+'">'+value.nombre_lug+'</option>');
        });
      });
  });
  $(function(){
    $('select[name=sel_estado_prin]').on("change", function(){
      var url = '<?php echo e(url('estado')); ?>/' + $(this).val() + '/municipios/';
      console.log(url);
      $.get(url, function(data) {
        var select = $('form select[name=sel_municipio_prin]');
        var clean = $('form select[name=sel_parroquia_prin]');
        select.empty();
        clean.empty();
        $.each(data, function(key, value){
          select.append('<option value="'+value.nombre_lug+'">'+value.nombre_lug+'</option>');
        });
      });
    });
  });
  $(function(){
    $('select[name=sel_municipio_prin]').on("change", function(){
      var url = '<?php echo e(url('municipio')); ?>/' + $(this).val() + '/parroquias/';
      console.log(url);
      $.get(url, function(data) {
        var select = $('form select[name=sel_parroquia_prin]');
        select.empty();
        $.each(data, function(key, value){
          select.append('<option value="'+value.id_lug+'">'+value.nombre_lug+'</option>');
        });
      });
    });
  });
  $(function(){
    $('select[name=sel_parroquia_prin]').on("change", function(){

    });
  });
  </script>
</html>
