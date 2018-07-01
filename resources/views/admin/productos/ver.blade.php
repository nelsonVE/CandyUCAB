@extends('layouts.admin')

@section('titulo')
CandyUcab - Ver productos
@endsection

@section('contenido')
<h1 class="text-center">Lista de productos</h1>
<br>
@switch((int)$estado)
  @case(-3)
    <div class="alert alert-danger text-center" role="alert">
      <h5>No se ha encontrado el producto seleccionado en la base de datos</h5>
    </div>
    @break
  @case(-2)
  <div class="alert alert-danger text-center" role="alert">
    <h5>Hubo un error al intentar eliminar el producto seleccionada</h5>
  </div>
  @break
  @case(1)
    <div class="alert alert-success text-center" role="alert">
      <h5>Producto editado con éxito</h5>
    </div>
    @break
  @case(2)
    <div class="alert alert-success text-center" role="alert">
      <h5>Producto eliminado con éxito</h5>
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
            <th>Descripción</th>
            <th>Acción</th>
        </tr>
    </thead>
    <!--Table head-->

    <!--Table body-->
    <tbody>
        @foreach($productos as $producto)
        <tr>
            <th scope="row">{{ $producto->id_car }}</th>
            <td>{{ $producto->nombre_car }}</td>
            <td>{{ $producto->desc_car }}</td>
            <td>
                <button type="button" class="btn btn-primary btn-rounded btn-sm my-0 mx-0" onclick="window.location='/admin/productos/{{ $producto->id_car }}/editar';"><i class="fas fa-edit"></i></button>
                <button type="button" class="btn btn-danger btn-rounded btn-sm my-0 mx-0" onclick="window.location='/admin/productos/{{ $producto->id_car }}/eliminar';"><i class="fas fa-trash-alt"></i></button>
            </td>
        </tr>
        @endforeach
    </tbody>
    <!--Table body-->

</table>
<!--Table-->
@endsection
