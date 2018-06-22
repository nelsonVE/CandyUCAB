

<?php $__env->startSection('titulo'); ?>
CandyUcab - Tienda
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contenido'); ?>
<div class="container-fluid"  style="background-color: rgba(0,0,0,0.5);">
  <div class="row pt-5 pb-5">
    <?php $__currentLoopData = $disponibles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $disponible): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="col-md-2 pt-4">
      <div class="card">
        <img class="card-img-top" src="<?php echo asset($productos[$disponible['fk_car']]->url_car); ?>" style="max-height: 200px;">
        <div class="card-body">
          <h4 class="card-title"><a><?php echo e($productos[$disponible['fk_car']]->nombre_car); ?></a></h4>
          <p class="card-text">
            <h5><?php echo e($productos[$disponible['fk_car']]->desc_car); ?></h5><br>
            Tamaño del dulce: <?php echo e($productos[$disponible['fk_car']]->tamanho_car); ?><br>
            Sabor del dulce: <?php echo e($productos[$disponible['fk_car']]->sabor_car); ?><br>
            Forma del dulce: <?php echo e($productos[$disponible['fk_car']]->forma_car); ?>

            <br><br>
            <h4>Precio: <?php echo e($productos[$disponible['fk_car']]->precio_car); ?></h4>
          </p>
        </div>
        <button type="button" class="btn btn-pink" onclick="window.location='/panel/tienda/candy/agregar/<?php echo e($disponible['fk_car']); ?>';">Agregar al carrito</button>
      </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.panel', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>