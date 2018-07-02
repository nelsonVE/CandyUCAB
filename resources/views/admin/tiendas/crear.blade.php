@extends('layouts.admin')

@section('titulo')
CandyUcab - Editar tiendas
@endsection

@section('contenido')
<h1>Creación de tiendas</h1>
<div class="col-md-12 col-sm-12 bg-content p-5">
  <form action="{{ url('/admin/tienda/crear/validar') }}" role="form" method="post">
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
      <h5>Datos principales de la tienda</h5>
      <div class="md-form">
          <input type="text" name="nombre" id="nombre" class="form-control" required>
          <label for="nombre">Nombre de la tienda</label>
      </div>
      <div class="md-form">
          <h5>Dirección de la tienda</h5>
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
        <h5>Tipo de tienda</h5>
        <select class="form-control form-control-sm" name="sel_tipo">
          <option value="0" selected>Mini</option>
          <option value="1">Super</option>
        </select>
      </div>
      <div class="text-center mt-4">
          <button class="btn btn-primary" type="submit">Crear tienda</button>
      </div>
  </form>
</div>
@endsection
