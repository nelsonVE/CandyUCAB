@extends('layouts.admin')

@section('titulo')
CandyUcab - Crear usuario
@endsection

@section('contenido')
<h1>Creación de usuarios</h1>
<div class="col-md-12 col-sm-12 bg-content p-5">
  <form action="{{ url('/admin/usuario/crear/validar') }}" role="form" method="post">
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
          <label for="nombre">Nombre de usuario:</label>
      </div>
      <div class="md-form">
          <input type="password" name="password" id="password" class="form-control" required>
          <label for="password">Contraseña:</label>
      </div>
      <div class="md-form">
          <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
          <label for="password_confirmation">Repita la contraseña:</label>
      </div>
      <br>
      Usuario destinado a:
      <br> <br>
      <div class="form-check">
        <input value="1" onClick="mostrarCampo(this)" class="form-check-input" type="radio" name="radiosUsuario" id="radioCliente" checked>
        <label class="form-check-label" for="radioCliente">
          Cliente
        </label>
      </div>
      <div class="form-check">
        <input value="2" onClick="mostrarCampo(this)" class="form-check-input" type="radio" name="radiosUsuario" id="radioPersonal">
        <label class="form-check-label" for="radioPersonal">
          Personal
        </label>
      </div>

      <div class="md-form" id="cliente">
          <input type="text" name="rif" id="clienteR" class="form-control" required>
          <label for="rif">RIF del cliente a asociar con esta cuenta:</label>
      </div>

      <div class="md-form" id="personal" style="display:none;">
          <input type="text" name="cedula" id="personalR" class="form-control">
          <label for="cedula">Cédula del empleado a asociar con esta cuenta:</label>
      </div>
      <br>
      Rol del usuario
      <br>
      <div class="md-form">
          <select class="form-control form-control-sm" name="rol">
            @foreach($roles as $rola)
            <option value="{{ $rola->id_rol }}">{{ $rola->tipo }}</option>
            @endforeach
          </select>
      </div>
      <div class="text-center mt-4">
          <button class="btn btn-primary" type="submit">Crear usuario</button>
      </div>
  </form>
</div>
@endsection
