<?php $__env->startSection('contenido'); ?>
<div class="container-fluid p-5" style="background-color: rgba(0,0,0,0.5);">
  <div class="container">
    <div class="row">
      <div class="col-md-3 col-sm-12">
        <h3></h3>
      </div>
      <div class="col-md-6 col-sm-12 bg-content p-5">
        <!-- Material form register -->
        <form action="<?php echo e(url('registro/crear')); ?>" role="form" method="post">
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
            <input type="hidden" name="_tipo" value="1">
            <p class="h4 text-center mb-4">Registro jurídico</p>
            <div class="md-form">
                <input type="text" name="rif" id="rif" class="form-control">
                <label for="rif">R.I.F</label>
            </div>

            <div class="md-form">
                <input type="text" name="denominacion_comercial" id="denominacion_comercial" class="form-control">
                <label for="denominacion_comercial">Denominación comercial</label>
            </div>

            <div class="md-form">
                <input type="text" name="razon_social" id="razon_social" class="form-control">
                <label for="razon_social">Razón social</label>
            </div>

            <div class="md-form">
                <input type="text" name="direccion_fiscal" id="direccion_fiscal" class="form-control">
                <label for="direccion_fiscal">Dirección fiscal</label>
            </div>

            <div class="md-form">
                <input type="text" name="direccion_fisica" id="direccion_fisica" class="form-control">
                <label for="direccion_fisica">Dirección física principal</label>
            </div>

            <div class="md-form">
                <input type="email" name="email" id="email" class="form-control">
                <label for="email">Dirección de e-mail</label>
            </div>

            <div class="md-form">
                <input type="email" name="comprobar-email" id="comprobar-email" class="form-control">
                <label for="comprobar-email">Re-ingrese su dirección de e-mail</label>
            </div>

            <div class="md-form">
                <input type="text" name="usuario" id="usuario" class="form-control">
                <label for="usuario">Usuario</label>
            </div>

            <div class="md-form">
                <input type="text" name="web" id="web" class="form-control">
                <label for="web">Página web</label>
            </div>

            <div class="md-form">
                <input type="password" name="password" id="password" class="form-control">
                <label for="password">Contraseña</label>
            </div>

            <div class="md-form">
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                <label for="password_confirmation">Re-ingrese su contraseña</label>
            </div>


            <div class="text-center mt-4">
                <button class="btn btn-pink" type="submit">Registrarme</button>
            </div>
        </form>
        <!-- Material form register -->

      </div>
      <div class="col-md-3 col-sm-12">
        <h3></h3>
      </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>