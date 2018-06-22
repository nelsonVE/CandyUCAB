<?php $__env->startSection('titulo'); ?>
CandyUcab - Panel administrativo
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contenido'); ?>
<div class="content-fluid">
  <h1 class="text-center">¡Bienvenido al panel administrativo de CandyUcab!</h1>
  <hr>
  <h5 class="text-justify">Desde acá podrás ejercer tus funciones como empleado de nuestras sucursales.
  Recuerda que de conseguir algún error en el sistema puedes notificarlo a nuestro
  servicio técnico el cual se encargará de solventarlo lo antes posible.</h5>
  <br><br>
  <h3 class="text-center">Servicio técnico: reportes@candyucab.com</h3>
  <br><br>
  <h4 class="text-center">¡Que tengas un día productivo! <?php echo e($rol); ?></h4>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>