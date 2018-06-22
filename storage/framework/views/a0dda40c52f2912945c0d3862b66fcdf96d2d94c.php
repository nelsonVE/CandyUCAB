<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title><?php echo $__env->yieldContent('titulo'); ?></title>
    <link rel="stylesheet" href="<?php echo asset('css/admin.css'); ?>">

    <link rel="stylesheet" href="<?php echo asset('fontawesome/css/all.css'); ?>">
    <!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.5.0/css/mdb.min.css" rel="stylesheet">

    <link rel="icon"

      href="{<?php echo asset('img/favicon.ico'); ?>}">

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
                <li <?php echo e((Request::is('admin/notificaciones') ? 'class=active' : '')); ?>>
                    <a href="<?php echo e(url('/admin/notificaciones')); ?>">
                        <i class="fas fa-exclamation-circle"></i>
                        Notificaciones
                    </a>
                </li>
                <li>
                    <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="fas fa-home"></i>
                        Tienda
                    </a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">
                        <li>
                            <a href="#">Registrar compra</a>
                        </li>
                    </ul>
                </li>
                <?php if($rol > 4): ?>
                <li>
                    <a href="<?php echo e(url('/admin/hacerinv')); ?>">
                        <i class="fas fa-box-open"></i>
                        Revisar inventario
                    </a>
                </li>
                <?php endif; ?>
                <li>
                    <a href="<?php echo e(url('/panel/salir')); ?>">
                        <i class="fas fa-paper-plane"></i>
                        Salir
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Page Content  -->
        <div id="content">
            <?php echo $__env->yieldContent('contenido'); ?>
        </div>
    </div>

    <!-- JQuery -->
    <script src="<?php echo asset('js/jquery-3.3.1.slim.min.js'); ?>"></script>
    <script src="<?php echo asset('mdb/js/jquery-3.3.1.js'); ?>"></script>
    <!-- Bootstrap tooltips -->
    <script src="<?php echo asset('mdb/js/popper.min.js'); ?>"></script>
    <!-- Bootstrap core JavaScript -->
    <script src="<?php echo asset('mdb/js/bootstrap.min.js'); ?>"></script>
    <!-- MDB core JavaScript -->
    <script src="<?php echo asset('mdb/js/mdb.min.js'); ?>"></script>

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
  </script>
</html>
