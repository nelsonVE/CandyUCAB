@extends('layouts.admin')

@section('titulo')
CandyUcab - Administrar roles
@endsection

@section('contenido')
<h1 class="text-center">Lista de roles</h1>
<br>
@switch((int)$estado)
  @case(-4)
    <div class="alert alert-danger text-center" role="alert">
      <h5>No tienes acceso a esta función</h5>
    </div>
    @break
  @case(-3)
    <div class="alert alert-danger text-center" role="alert">
      <h5>No se ha encontrado el rol seleccionado en la base de datos</h5>
    </div>
    @break
  @case(-2)
  <div class="alert alert-danger text-center" role="alert">
    <h5>Hubo un error al intentar eliminar el rol seleccionado</h5>
  </div>
  @break
  @case(1)
    <div class="alert alert-success text-center" role="alert">
      <h5>Rol editado con éxito</h5>
    </div>
    @break
  @case(2)
    <div class="alert alert-success text-center" role="alert">
      <h5>Rol eliminado con éxito</h5>
    </div>
    @break
@endswitch
<!--Table-->
<table class="table">
    <!--Table head-->
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Acción</th>
        </tr>
    </thead>
    <!--Table head-->

    <!--Table body-->
    <tbody>
        @foreach($roles as $rola)
        <tr>
            <th scope="row">{{ $rola->id_rol }}</th>
            <td>{{ $rola->tipo }}</td>
            <td>
                <button type="button" class="btn btn-primary btn-rounded btn-sm my-0 mx-0" onclick="window.location='/admin/roles/{{ $rola->id_rol }}/editar';"><i class="fas fa-edit"></i></button>
        </tr>
        @endforeach
    </tbody>
    <!--Table body-->

</table>
<!--Table-->
@endsection
