<?php $__env->startSection('titulo'); ?>
CandyUcab - Agregar al carrito
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contenido'); ?>

<div class="container-fluid"  style="background-color: rgba(0,0,0,0.5);">
  <div class="container pt-5 pb-5 bg-white text-center">
    <!--Table-->
      <form action="<?php echo e(url('/panel/tienda/candy/procesar')); ?>" role="form" method="post">
          <?php if(count($errors) > 0): ?>
             <div class = "alert alert-danger">
                <ul>
                   <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <li><?php echo e($error); ?></li>
                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
             </div>
          <?php endif; ?>
          <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
          <input type="hidden" name="producto" value="<?php echo e($id_car); ?>">
          <!--Table head-->
          <table class="table table-hover w-auto" style="border-radius: 2px;">
          <thead>
              <tr>
                  <th></th>
                  <th>Nombre del producto</th>
                  <th>Sabor</th>
                  <th>Precio</th>
                  <th>Cantidad</th>
              </tr>
          </thead>
          <!--Table head-->

          <!--Table body-->
          <tbody>
              <tr>
                  <td> <img src="<?php echo asset($productos[$id_car]->url_car); ?>" style="max-width:50px; max-height:50px;"> </td>
                  <td><?php echo e($productos[$id_car]->nombre_car); ?></td>
                  <td><?php echo e($productos[$id_car]->sabor_car); ?></td>
                  <td><?php echo e($productos[$id_car]->precio_car); ?></td>
                  <td> <input type="number" name="cantidad" value="1" min="1" style="width:3em; text-align:center;"></td>
              </tr>
          </tbody>
          <!--Table body-->
      </table>
      <button type="submit" class="btn btn-pink" style="width:100%">Agregar al carrito</button>

    </form>
  </div>
</div>
<!--Table-->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.panel', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>