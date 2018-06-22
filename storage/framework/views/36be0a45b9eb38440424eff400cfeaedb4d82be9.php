

<?php $__env->startSection('titulo'); ?>
CandyUcab - Login
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contenido'); ?>

<div class="container-fluid p-5" style="background-color: rgba(0,0,0,0.5);">
  <div class="container">
    <div class="row">
      <div class="col-md-3 col-sm-12">
        <h3></h3>
      </div>
      <?php if(Auth::guest()): ?>
      <div class="col-md-6 col-sm-12 bg-content p-5">
        <form action="<?php echo e(url('/login/verificar')); ?>" role="form" method="post">
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
            <p class="h4 text-center mb-4">Ingresar a CandyUcab</p>
            <div class="md-form">
                <input type="text" name="usuario" id="usuario" class="form-control" required>
                <label for="usuario">Usuario</label>
            </div>

            <div class="md-form">
                <input type="password" name="password" id="password" class="form-control" required>
                <label for="password">Contraseña</label>
            </div>

            <div class="text-center mt-4">
                <button class="btn btn-pink" type="submit">Ingresar</button>
            </div>
        </form>
      </div>
      <?php endif; ?>
      <div class="col-md-3 col-sm-12">
        <h3></h3>
      </div>
    </div>
  </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>