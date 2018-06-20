@extends('layouts.app')

@section('contenido')
<?php //dd($lugar); ?>
<div class="container-fluid p-5" style="background-color: rgba(0,0,0,0.5);">
  <div class="container">
    <div class="row">
      <div class="col-md-3 col-sm-12">
        <h3></h3>
      </div>
      <div class="col-md-6 col-sm-12 bg-content p-5">
        <!-- Material form register -->
        <form action="{{ url('registro/crear') }}" role="form" method="post">
            @if (count($errors) > 0)
               <div class = "alert alert-danger">
                  <ul>
                     @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                     @endforeach
                  </ul>
               </div>
            @endif
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="_tipo" value="0">
            <p class="h4 text-center mb-4">Registro natural</p>
            <br>
            <h5>Datos principales:</h5>
            <div class="md-form">
                <input type="text" name="rif" id="rif" class="form-control" required>
                <label for="rif">R.I.F</label>
            </div>
            <br>
            Nacionalidad
            <div class="md-form">
                <select class="form-control form-control-sm" name="nacionalidad">
                  <option value="V">Venezolana</option>
                  <option value="E">Extranjera</option>
                </select>
            </div>

            <div class="md-form">
                <input type="text" name="cedula" id="cedula" class="form-control" required>
                <label for="cedula">Cédula:</label>
            </div>

            <div class="md-form">
                <input type="text" name="primer_nombre" id="primer_nombre" class="form-control" required>
                <label for="primer_nombre">Primer nombre:</label>
            </div>

            <div class="md-form">
                <input type="text" name="segundo_nombre" id="segundo_nombre" class="form-control" required>
                <label for="segundo_nombre">Segundo nombre</label>
            </div>

            <div class="md-form">
                <input type="text" name="primer_apellido" id="primer_apellido" class="form-control" required>
                <label for="primer_apellido">Primer apellido</label>
            </div>

            <div class="md-form">
                <input type="text" name="segundo_apellido" id="segundo_apellido" class="form-control">
                <label for="segundo_apellido">Segundo apellido (opcional)</label>
            </div>

            <div class="md-form">
                <input type="text" name="usuario" id="usuario" class="form-control" required>
                <label for="usuario">Usuario</label>
            </div>

            <div class="md-form">
                <h5>Dirección de habitación</h5>
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
                <input type="text" name="telefono" id="telefono" class="form-control" required>
                <label for="telefono">Telefono:</label>
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
        <!-- Material form register -->

      </div>
      <div class="col-md-3 col-sm-12">
        <h3></h3>
      </div>
    </div>
  </div>
</div>

@endsection
