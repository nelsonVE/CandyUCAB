@extends('layouts.admin')

@section('titulo')
CandyUcab - Ver tiendas
@endsection

@section('contenido')
<h1 class="text-center">Lista de tiendas</h1>
<br>
@switch((int)$estado)
  @case(-3)
    <div class="alert alert-danger text-center" role="alert">
      <h5>No se ha encontrado la tienda seleccionada en la base de datos</h5>
    </div>
    @break
  @case(-2)
  <div class="alert alert-danger text-center" role="alert">
    <h5>Hubo un error al intentar eliminar la tienda seleccionada</h5>
  </div>
  @break
  @case(1)
    <div class="alert alert-success text-center" role="alert">
      <h5>Tienda editada con éxito</h5>
    </div>
    @break
  @case(2)
    <div class="alert alert-success text-center" role="alert">
      <h5>Tienda eliminada con éxito</h5>
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
        @foreach($tiendas as $tienda)
        <tr>
            <th scope="row">{{ $tienda->id_tie }}</th>
            <td>{{ $tienda->nombre_tie }}</td>
            <td>
                <button type="button" class="btn btn-primary btn-rounded btn-sm my-0 mx-0" onclick="window.location='/admin/tiendas/{{ $tienda->id_tie }}/editar';"><i class="fas fa-edit"></i></button>
                <button type="button" class="btn btn-danger btn-rounded btn-sm my-0 mx-0" onclick="window.location='/admin/tiendas/{{ $tienda->id_tie }}/eliminar';"><i class="fas fa-trash-alt"></i></button>
            </td>
        </tr>
        @endforeach
    </tbody>
    <!--Table body-->

</table>
<!--Table-->
@endsection
