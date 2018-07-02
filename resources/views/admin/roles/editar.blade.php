@extends('layouts.admin')

@section('titulo')
CandyUcab - Editar rol
@endsection

@section('contenido')
<h1>Edición de rol (#{{ $rola->id_rol }})</h1>
<div class="col-md-12 col-sm-12 bg-content p-5">
  <form action="/admin/roles/{{ $rola->id_rol }}/guardar" role="form" method="post">
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
          <input value="{{ $rola->tipo }}" type="text" name="tipo" id="tipo" class="form-control" required>
          <label for="tipo">Nombre del rol:</label>
      </div><br>
      Lista de permisos:
      <br>
      @foreach($permisos as $permiso)
        <div class="form-check">
            <input @foreach($rol_pers as $rol_per) @if($permiso->id_per == $rol_per->fk_per) checked @endif @endforeach class="form-check-input" type="checkbox" value="{{ $permiso->id_per }}" name= "{{ 'p'.$permiso->id_per }}" id="{{ $permiso->id_per }}">
            <label class="form-check-label" for="{{ $permiso->id_per }}">
              {{ $permiso->desc_per }}
            </label>
        </div>
      @endforeach
      <div class="text-center mt-4">
          <button class="btn btn-primary" type="submit">Editar</button>
      </div>
  </form>
</div>
@endsection
