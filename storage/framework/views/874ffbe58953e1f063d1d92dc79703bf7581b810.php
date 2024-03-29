<?php $__env->startSection('contenido'); ?>
<div class="container-fluid p-5" style="background-color: rgba(0,0,0,0.5);">
  <div class="container">
    <div class="row">
      <div class="col-md-3 col-sm-12">
        <h3></h3>
      </div>
      <div class="col-md-6 col-sm-12 bg-content p-5">
        <!-- Material form register -->
        <form>
            <p class="h4 text-center mb-4">Registro jurídico</p>

            <div class="md-form">
                <input type="text" id="rif" class="form-control">
                <label for="rif">R.I.F</label>
            </div>

            <div class="md-form">
                <input type="text" id="denominacion-comercial" class="form-control">
                <label for="denominacion-comercial">Denominación comercial</label>
            </div>

            <div class="md-form">
                <input type="text" id="razon-social" class="form-control">
                <label for="razon-social">Razón social</label>
            </div>

            <div class="md-form">
                <input type="text" id="direccion-fiscal" class="form-control">
                <label for="direccion-fiscal">Dirección fiscal</label>
            </div>

            <div class="md-form">
                <input type="text" id="direccion-fisica" class="form-control">
                <label for="direccion-fisica">Dirección física principal</label>
            </div>

            <div class="md-form">
                <input type="email" id="email" class="form-control">
                <label for="email">Dirección de e-mail</label>
            </div>

            <div class="md-form">
                <input type="email" id="comprobar-email" class="form-control">
                <label for="comprobar-email">Re-ingrese su dirección de e-mail</label>
            </div>

            <div class="md-form">
                <input type="password" id="password" class="form-control">
                <label for="password">Contraseña</label>
            </div>

            <div class="md-form">
                <input type="password" id="comprobar-password" class="form-control">
                <label for="comprobar-password">Re-ingrese su contraseña</label>
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