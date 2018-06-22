<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>@yield('titulo')</title>
    <link rel="stylesheet" href="{!! asset('css/header.css') !!}">

    <link rel="stylesheet" href="/fontawesome/css/all.css">
    <!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.5.0/css/mdb.min.css" rel="stylesheet">

    <link rel="icon"
      type="image/png"
      href="{{!! asset('img/favicon.ico') !!}}">
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
              <a class="nav-link" href="/panel">Inicio</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/productos">Productos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/panel/tienda">Tienda</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/contacto">Contáctanos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/acerca">Acerca de nostros</a>
            </li>
          </ul>
          <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ $usuario }}</a>
                <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="/panel/perfil">Perfil</a>
                    <a class="dropdown-item" href="/panel/configuracion">Configuración</a>
                    @if($rol > 1)
                    <a class="dropdown-item" href="/admin">Administración</a>
                    @endif
                    <a class="dropdown-item" href="/panel/salir">Salir</a>
                </div>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    @yield('contenido')
    <script src="{!! asset('js/jquery-3.3.1.slim.min.js') !!}"></script>
    <script src="{!! asset('mdb/js/jquery-3.3.1.js') !!}"></script>
    <!-- Bootstrap tooltips -->
    <script src="{!! asset('mdb/js/popper.min.js') !!}"></script>
    <!-- Bootstrap core JavaScript -->
    <script src="{!! asset('mdb/js/bootstrap.min.js') !!}"></script>
    <!-- MDB core JavaScript -->
    <script src="{!! asset('mdb/js/mdb.min.js') !!}"></script>
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
</html>
