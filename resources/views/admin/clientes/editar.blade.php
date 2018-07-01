@extends('layouts.admin')

@section('titulo')
CandyUcab - Editar cliente
@endsection

<?php
  $telefono = \DB::table('telefono')->where('fk_cli', $cliente->id_cli)->first();
  $numero_ci = preg_replace("/[^0-9]/", "", $cliente->cedula_nat);
?>
@section('contenido')
<h1>Edición de clientes (#{{ $cliente->id_cli }})</h1>
<div class="col-md-12 col-sm-12 bg-content p-5">
  <form action="/admin/clientes/{{ $cliente->id_cli }}/guardar" role="form" method="post">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      @if (count($errors) > 0)
         <div class = "alert alert-danger">
            <ul>
               @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
               @endforeach
            </ul>
         </div>
      @endif
      @if($cliente->tipo == 1)
      <br>
      <h5>Datos principales:</h5>
      <div class="md-form">
          <input value="{{ $cliente->rif_cli }}" type="text" name="rif" id="rif" class="form-control" required>
          <label for="rif">R.I.F</label>
      </div>

      <div class="md-form">
          <input value="{{ $cliente->den_com_jur }}" type="text" name="denominacion_comercial" id="denominacion_comercial" class="form-control" required>
          <label for="denominacion_comercial">Denominación comercial</label>
      </div>

      <div class="md-form">
          <input value="{{ $cliente->raz_soc_jur }}" type="text" name="razon_social" id="razon_social" class="form-control" required>
          <label for="razon_social">Razón social</label>
      </div>

      <div class="md-form">
          <input value="{{ $cliente->capital_jur }}" type="text" name="capital" id="capital" class="form-control" required>
          <label for="razon_social">Capital</label>
      </div>
      <br>
      <h5>Otros datos:</h5>

      <div class="md-form">
          <input value="{{ $cliente->correo_cli }}" type="email" name="email" id="email" class="form-control" required>
          <label for="email">Dirección de e-mail</label>
      </div>

      <div class="md-form">
          <input value="{{ $cliente->pag_web_jur }}" type="text" name="web" id="web" class="form-control" required>
          <label for="web">Página web</label>
      </div>
    @else
      <div class="md-form">
          <input value="{{ $cliente->rif_cli }}" type="text" name="rif" id="rif" class="form-control" required>
          <label for="rif">R.I.F</label>
      </div>
      <br>
      Nacionalidad
      <div class="md-form">
          <select class="form-control form-control-sm" name="nacionalidad">
            <option value="V" >Venezolana</option>
            <option value="E" >Extranjera</option>
          </select>
      </div>

      <div class="md-form">
          <input value="{{ $numero_ci }}" type="text" name="cedula" id="cedula" class="form-control" required>
          <label for="cedula">Cédula:</label>
      </div>

      <div class="md-form">
          <input value="{{ $cliente->nombre_1_nat }}" type="text" name="primer_nombre" id="primer_nombre" class="form-control" required>
          <label for="primer_nombre">Primer nombre:</label>
      </div>

      <div class="md-form">
          <input value="{{ $cliente->nombre_2_nat }}" type="text" name="segundo_nombre" id="segundo_nombre" class="form-control" required>
          <label for="segundo_nombre">Segundo nombre</label>
      </div>

      <div class="md-form">
          <input value="{{ $cliente->apellido_1_nat }}" type="text" name="primer_apellido" id="primer_apellido" class="form-control" required>
          <label for="primer_apellido">Primer apellido</label>
      </div>

      <div class="md-form">
          <input value="{{ $cliente->apellido_2_nat }}" type="text" name="segundo_apellido" id="segundo_apellido" class="form-control">
          <label for="segundo_apellido">Segundo apellido (opcional)</label>
      </div>

      <h5>E-mail:</h5>

      <div class="md-form">
          <input value="{{ $cliente->correo_cli }}" type="email" name="email" id="email" class="form-control" required>
          <label for="email">Dirección de e-mail</label>
      </div>
    @endif
      @if($telefono)
      <div class="md-form">
          <input value="{{ $telefono->numero_tel }}" type="text" name="telefono" id="telefono" class="form-control" required>
          <label for="telefono">Telefono:</label>
      </div>
      @endif
      <div class="text-center mt-4">
          <button class="btn btn-primary" type="submit">Editar</button>
      </div>
  </form>
</div>
@endsection
