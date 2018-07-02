<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>@yield('titulo')</title>
    <link rel="stylesheet" href="{!! asset('css/admin.css') !!}">

    <link rel="stylesheet" href="{!! asset('fontawesome/css/all.css') !!}">
    <!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.5.0/css/mdb.min.css" rel="stylesheet">

    <link rel="icon"

      href="{{!! asset('img/favicon.ico') !!}}">

  </head>
  <body>
    <nav class="navbar">
      <button type="button" id="sidebarCollapse" class="btn btn-info">
        <i class="fas fa-align-justify"></i>
      </button>
    </nav>
    <div class="wrapper" style="margin-top:-2.5em;">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3>CandyUcab</h3>
                <strong>CU</strong>
            </div>

            <ul class="list-unstyled components">
                <li {{{ (Request::is('admin/notificaciones') ? 'class=active' : '') }}}>
                    <a href="{{ url('/admin/notificaciones') }}">
                        <i class="fas fa-exclamation-circle"></i>
                        Notificaciones
                    </a>
                </li>
                <li>
                    <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="fas fa-home"></i>
                        Tiendas
                    </a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">
                        <li>
                            <a href="{{ url('/admin/tienda/crear') }}">Crear tienda</a>
                        </li>
                        <li>
                            <a href="{{ url('/admin/tiendas') }}">Lista de tiendas</a>
                        </li>
                        <li>
                            <a href="#">Registrar compra</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#productoSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="fas fa-clipboard-list"> </i>
                        Productos
                    </a>
                    <ul class="collapse list-unstyled" id="productoSubmenu">
                        <li>
                            <a href="{{ url('/admin/producto/crear') }}">Crear producto</a>
                        </li>
                        <li>
                            <a href="{{ url('/admin/productos') }}">Lista de productos</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#clienteSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="fas fa-users"> </i>
                        Clientes
                    </a>
                    <ul class="collapse list-unstyled" id="clienteSubmenu">
                        <li>
                            <a href="{{ url('/admin/cliente/crear') }}">Crear cliente</a>
                        </li>
                        <li>
                            <a href="{{ url('/admin/clientes') }}">Lista de clientes</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#usuariosSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="fas fa-user-circle"> </i>
                        Usuarios
                    </a>
                    <ul class="collapse list-unstyled" id="usuariosSubmenu">
                        <li>
                            <a href="{{ url('/admin/usuario/crear') }}">Crear usuario</a>
                        </li>
                        <li>
                            <a href="{{ url('/admin/usuarios') }}">Lista de usuarios</a>
                        </li>
                        <li>
                            <a href="{{ url('/admin/roles') }}">Administrar roles</a>
                        </li>
                    </ul>
                </li>
                @if(checkPermiso($rol, 4))
                <li>
                    <a href="#diarioSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="fas fa-book-open"> </i>
                        Diario Dulce
                    </a>
                    <ul class="collapse list-unstyled" id="diarioSubmenu">
                        <li>
                            <a href="{{ url('/admin/diario/ofertas') }}">Ver oferta</a>
                        </li>
                        <li>
                            <a href="{{ url('/admin/diario/oferta/crear') }}">Crear oferta</a>
                        </li>
                        <li>
                            <a href="/admin/diario/forzar">Forzar emisión</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="{{ url('/admin/hacerinv') }}">
                        <i class="fas fa-box-open"></i>
                        Revisar inventario
                    </a>
                </li>
                @endif
                <li>
                    <a href="{{ url('/panel/salir') }}">
                        <i class="fas fa-paper-plane"></i>
                        Salir
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Page Content  -->
        <div id="content">
            @yield('contenido')
        </div>
    </div>

    <!-- JQuery -->
    <script src="{!! asset('js/jquery-3.3.1.slim.min.js') !!}"></script>
    <script src="{!! asset('mdb/js/jquery-3.3.1.min.js') !!}"></script>
    <!-- Bootstrap tooltips -->
    <script src="{!! asset('mdb/js/popper.min.js') !!}"></script>
    <!-- Bootstrap core JavaScript -->
    <script src="{!! asset('mdb/js/bootstrap.min.js') !!}"></script>
    <!-- MDB core JavaScript -->
    <script src="{!! asset('mdb/js/mdb.min.js') !!}"></script>

	<!--Copyright-->
	<div class="footer-copyright py-3 text-center">
	© 2018 - Todos los derechos reservados a sus respectivos autores.
	</div>
	<!--/.Copyright-->

	</footer>
	<!--/.Footer-->
  </body>
  <script type="text/javascript">
      $(document).ready(function () {
          $('#sidebarCollapse').on('click', function () {
              $('#sidebar').toggleClass('active');
          });
      });
      $(function(){
          var url = '{{ url('estado')}}/' + $(this).val() + '/municipios/';
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
          var url = '{{ url('estado')}}/' + $(this).val() + '/municipios/';
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
          var url = '{{ url('municipio')}}/' + $(this).val() + '/parroquias/';
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
          var url = '{{ url('estado')}}/' + $(this).val() + '/municipios/';
          console.log(url);
          $.get(url, function(data) {
            var select = $('form select[name=sel_municipio]');
            select.empty();
            $.each(data, function(key, value){
              select.append('<option value="'+value.nombre_lug+'">'+value.nombre_lug+'</option>');
            });
          });
      });
      function mostrarCampo(c){
        if(c.value == "1"){
          document.getElementById("cliente").style.display='block';
          document.getElementById("personal").style.display='none';
          document.getElementById("clienteR").attributes.required=true;
          document.getElementById("personalR").removeAttribute("required");
        } else if(c.value =="2") {
          document.getElementById("cliente").style.display='none';
          document.getElementById("personal").style.display='block';
          document.getElementById("personalR").attributes.required=true;
          document.getElementById("clienteR").removeAttribute("required");
        }
      }
  </script>
</html>
