@extends('layouts.admin')

@section('titulo')
CandyUcab - Ver usuarios
@endsection

@section('contenido')
<h1 class="text-center">Lista de usuarios</h1>
<br>
@switch((int)$estado)
  @case(-4)
    <div class="alert alert-danger text-center" role="alert">
      <h5>Solo los administradores tienen acceso a esta funcionalidad</h5>
    </div>
    @break
  @case(-3)
    <div class="alert alert-danger text-center" role="alert">
      <h5>No se ha encontrado el usuario seleccionado en la base de datos</h5>
    </div>
    @break
  @case(-2)
  <div class="alert alert-danger text-center" role="alert">
    <h5>Hubo un error al intentar eliminar el usuario seleccionado</h5>
  </div>
  @break
  @case(1)
    <div class="alert alert-success text-center" role="alert">
      <h5>Usuario editado con éxito</h5>
    </div>
    @break
  @case(2)
    <div class="alert alert-success text-center" role="alert">
      <h5>Usuario eliminado con éxito</h5>
    </div>
    @break
@endswitch
<!--Table-->
<table class="table">
    <!--Table head-->
    <thead>
        <tr>
            <th>ID</th>
            <th>Usuario</th>
            <th>Rol</th>
            <th>Pertenece a:</th>
            <th>Acción</th>
        </tr>
    </thead>
    <!--Table head-->

    <!--Table body-->
    <tbody>
        @foreach($usuarios as $usuario)
        <tr>
            <th scope="row">{{ $usuario->id_usu }}</th>
            <td>{{ $usuario->usuario }}</td>
            <td>{{ $usuario->fk_rol }}</td>
            <td><?php echo($usuario->fk_per) ? '<strong style=\'color: red; \'>Empleado<strong>' : '<strong style=\'color: green; \'>Cliente<strong>';?></td>
            <td>
                <button type="button" class="btn btn-primary btn-rounded btn-sm my-0 mx-0" onclick="window.location='/admin/usuarios/{{ $usuario->id_usu }}/editar';"><i class="fas fa-edit"></i></button>
                <button type="button" class="btn btn-danger btn-rounded btn-sm my-0 mx-0" onclick="window.location='/admin/usuarios/{{ $usuario->id_usu }}/eliminar';"><i class="fas fa-trash-alt"></i></button>
            </td>
        </tr>
        @endforeach
    </tbody>
    <!--Table body-->

</table>
<!--Table-->
@endsection
