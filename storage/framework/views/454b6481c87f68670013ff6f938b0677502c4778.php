<?php $__env->startSection('titulo'); ?>
CandyUcab - La página no existe
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contenido'); ?>
  <div class="col-md-12 col-sm-12 mt-5 mb-5 z-depth-1 p-5 text-center alert alert-danger">
    <h2><strong>Error 404:</strong></h2><br><br>
    <h5>La página solicitada no existe.</h5>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>