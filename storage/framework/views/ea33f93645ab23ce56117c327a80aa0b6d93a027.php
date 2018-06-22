

<?php $__env->startSection('titulo'); ?>
CandyUcab - Inventario
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contenido'); ?>
  <div class="container-fluid">
    <div class="row">
      <?php if(isset($productos)): ?>
      <?php $__currentLoopData = $productos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $producto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="col-md-12 col-sm-12 alert alert-danger">
        <strong>Zona <?php echo e($producto['letra_zon']); ?> pasillo <?php echo e($producto['pasillo']); ?></strong>
        Existe un stock total de <?php echo e($producto['cantidad']); ?>. Es necesaria la reposición.
      </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <button type="button" name="button" class="btn btn-primary" onclick="location.href='/admin/reponer/<?php echo e($productos[0]['tienda']); ?>';" style="width:100%;">Reponer inventario</button>
      <?php else: ?>
      <div class="col-md-12 col-sm-12 alert alert-success">
        <strong>Esta tienda no posee zonas que necesiten reposición</strong>
      </div>
      <?php endif; ?>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>