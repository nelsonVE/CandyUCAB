@extends('layouts.admin')

@section('titulo')
CandyUcab - Editar usuarios
@endsection

@section('contenido')
<h1>Edición de usuarios (#{{ $usuario->id_usu }})</h1>
<div class="col-md-12 col-sm-12 bg-content p-5">
  <form action="/admin/usuarios/{{ $usuario->id_usu }}/guardar" role="form" method="post">
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
      <div class="md-form">
          <input value="{{ $usuario->usuario }}" type="text" name="usuario" id="usuario" class="form-control" required>
          <label for="usuario">Nombre de usuario:</label>
      </div><br>
      Rol:
      <br>
      <div class="md-form">
          <select class="form-control form-control-sm" name="rol">
            @foreach($roles as $rola)
            <option value="{{ $rola->id_rol }}" @if($rola->id_rol == $usuario->fk_rol) selected @endif>{{ $rola->tipo }}</option>
            @endforeach
          </select>
      </div>

      <div class="text-center mt-4">
          <button class="btn btn-primary" type="submit">Editar</button>
      </div>
  </form>
</div>
@endsection
