<?php $__env->startSection('titulo'); ?>
CandyUcab - Productos
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contenido'); ?>
<div class="container-fluid pt-1 pb-5"  style="background-color: rgba(0,0,0,0.5);">
  <div class="row">
    <?php $__currentLoopData = $productos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $producto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="col-md-2 pt-4">
      <div class="card">
        <img class="card-img-top" src="<?php echo asset($producto->url_car); ?>" style="max-height: 200px;">
        <div class="card-body">
          <h4 class="card-title"><a><?php echo e($producto->nombre_car); ?></a></h4>
          <p class="card-text">
            <h5><?php echo e($producto->desc_car); ?></h5><br>
            Tamaño del dulce: <?php echo e($producto->tamanho_car); ?><br>
            Sabor del dulce: <?php echo e($producto->sabor_car); ?><br>
            Forma del dulce: <?php echo e($producto->forma_car); ?>

          </p>
        </div>
      </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.panel', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>