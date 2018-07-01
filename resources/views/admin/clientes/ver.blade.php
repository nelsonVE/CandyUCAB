@extends('layouts.admin')

@section('titulo')
CandyUcab - Ver clientes
@endsection

@section('contenido')
<h1 class="text-center">Lista de clientes</h1>
<br>
@switch((int)$estado)
  @case(-3)
    <div class="alert alert-danger text-center" role="alert">
      <h5>No se ha encontrado el cliente seleccionado en la base de datos</h5>
    </div>
    @break
  @case(-2)
  <div class="alert alert-danger text-center" role="alert">
    <h5>Hubo un error al intentar eliminar el cliente seleccionada</h5>
  </div>
  @break
  @case(1)
    <div class="alert alert-success text-center" role="alert">
      <h5>Cliente editado con éxito</h5>
    </div>
    @break
  @case(2)
    <div class="alert alert-success text-center" role="alert">
      <h5>Cliente eliminado con éxito</h5>
    </div>
    @break
@endswitch
<!--Table-->
<table class="table">
    <!--Table head-->
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre o razón social</th>
            <th>Apellido o denominación comercial</th>
            <th>Tipo</th>
            <th>R.I.F</th>
        </tr>
    </thead>
    <!--Table head-->

    <!--Table body-->
    <tbody>
        @foreach($clientes as $cliente)
        <tr>
            <th scope="row">{{ $cliente->id_cli }}</th>
            @if($cliente->tipo == 1)
              <td>{{ $cliente->raz_soc_jur }}</td>
              <td>{{ $cliente->den_com_jur }}</td>
            @else
              <td>{{ $cliente->nombre_1_nat }}</td>
              <td>{{ $cliente->apellido_1_nat }}</td>
            @endif

            <td><?php echo($cliente->tipo == 1) ? '<strong style=\'color: red; \'>Jurídico<strong>' : '<strong style=\'color: green; \'>Natural<strong>';?></td>
            <td>
                <button type="button" class="btn btn-primary btn-rounded btn-sm my-0 mx-0" onclick="window.location='/admin/clientes/{{ $cliente->id_cli }}/editar';"><i class="fas fa-edit"></i></button>
                <button type="button" class="btn btn-danger btn-rounded btn-sm my-0 mx-0" onclick="window.location='/admin/clientes/{{ $cliente->id_cli }}/eliminar';"><i class="fas fa-trash-alt"></i></button>
            </td>
        </tr>
        @endforeach
    </tbody>
    <!--Table body-->

</table>
<!--Table-->
@endsection
