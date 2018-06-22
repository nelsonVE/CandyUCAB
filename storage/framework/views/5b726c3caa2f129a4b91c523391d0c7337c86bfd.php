

<?php $__env->startSection('titulo'); ?>
CandyUcab - Registro jurídico
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contenido'); ?>
<?php //dd($lugar); ?>
<div class="container-fluid p-5" style="background-color: rgba(0,0,0,0.5);">
  <div class="container">
    <div class="row">
      <div class="col-md-3 col-sm-12">
        <h3></h3>
      </div>
      <?php if(Auth::guest()): ?>
      <div class="col-md-6 col-sm-12 bg-content p-5">
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
            <br>
            <h5>Datos principales:</h5>
            <div class="md-form">
                <input type="text" name="rif" id="rif" class="form-control" required>
                <label for="rif">R.I.F</label>
            </div>

            <div class="md-form">
                <input type="text" name="denominacion_comercial" id="denominacion_comercial" class="form-control" required>
                <label for="denominacion_comercial">Denominación comercial</label>
            </div>

            <div class="md-form">
                <input type="text" name="razon_social" id="razon_social" class="form-control" required>
                <label for="razon_social">Razón social</label>
            </div>

            <div class="md-form">
                <input type="text" name="capital" id="capital" class="form-control" required>
                <label for="razon_social">Capital</label>
            </div>

            <div class="md-form">
                <input type="text" name="telefono" id="telefono" class="form-control" required>
                <label for="razon_social">Teléfono</label>
            </div>

            <div class="md-form">
                <input type="text" name="usuario" id="usuario" class="form-control" required>
                <label for="usuario">Usuario</label>
            </div>

            <div class="md-form">
                <h5>Dirección física</h5>
                Estado
                <select class="form-control form-control-sm" name="sel_estado">
                  <?php
                  foreach($lugar as $lug){
                    if($lug->tipo_lug == "Estado")
                      echo '<option>'.$lug->nombre_lug.'</option>';
                  }
                  ?>
                </select>
            </div>
            <div class="md-form">
              Municipio
              <select class="form-control form-control-sm" name="sel_municipio">
                  <?php
                  foreach($lugar as $lug){
                    if($lug->tipo_lug == "Municipio" && $lug->fk_lug == 1)
                      echo '<option>'.$lug->nombre_lug.'</option>';
                  }
                  ?>
              </select>
            </div>
            <div class="md-form">
              Parroquia
              <select class="form-control form-control-sm" name="sel_parroquia">

              </select>
            </div>

            <div class="md-form">
                <h5>Dirección física principal</h5>
                Estado
                <select class="form-control form-control-sm" name="sel_estado_prin">
                  <?php
                  foreach($lugar as $lug){
                    if($lug->tipo_lug == "Estado")
                      echo '<option>'.$lug->nombre_lug.'</option>';
                  }
                  ?>
                </select>
            </div>
            <div class="md-form">
              Municipio
              <select class="form-control form-control-sm" name="sel_municipio_prin">
                  <?php
                  foreach($lugar as $lug){
                    if($lug->tipo_lug == "Municipio" && $lug->fk_lug == 1)
                      echo '<option>'.$lug->nombre_lug.'</option>';
                  }
                  ?>
              </select>
            </div>
            <div class="md-form">
              Parroquia
              <select class="form-control form-control-sm" name="sel_parroquia_prin">

              </select>
            </div>

            <br>
            <h5>E-mail:</h5>

            <div class="md-form">
                <input type="email" name="email" id="email" class="form-control" required>
                <label for="email">Dirección de e-mail</label>
            </div>

            <div class="md-form">
                <input type="email" name="comprobar-email" id="comprobar-email" class="form-control" required>
                <label for="comprobar-email">Re-ingrese su dirección de e-mail</label>
            </div>

            <div class="md-form">
                <input type="text" name="web" id="web" class="form-control" required>
                <label for="web">Página web</label>
            </div>
            <br>
            <h5>Persona de contacto</h5>
            <div class="md-form">
                <select class="form-control form-control-sm" name="nac_percon">
                  <option value="V">Venezolano</option>
                  <option value="E">Extranjero</option>
                </select>
            </div>
            <div class="md-form">
                <input type="text" name="ci_percon" id="ci_percon" class="form-control" required>
                <label for="web">Cédula:</label>
            </div>

            <div class="md-form">
                <input type="text" name="nom_percon" id="nom_percon" class="form-control" required>
                <label for="web">Nombre:</label>
            </div>

            <div class="md-form">
                <input type="text" name="ape_percon" id="ape_percon" class="form-control" required>
                <label for="web">Apellido:</label>
            </div>

            <div class="md-form">
                <input type="text" name="tel_percon" id="tel_percon" class="form-control" required>
                <label for="web">Telefono:</label>
            </div>

            <br>
            <h5>Contraseña:</h5>

            <div class="md-form">
                <input type="password" name="password" id="password" class="form-control" required>
                <label for="password">Contraseña</label>
            </div>

            <div class="md-form">
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                <label for="password_confirmation">Re-ingrese su contraseña</label>
            </div>


            <div class="text-center mt-4">
                <button class="btn btn-pink" type="submit">Registrarme</button>
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