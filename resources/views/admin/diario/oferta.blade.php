@extends('layouts.admin')

@section('titulo')
CandyUcab - Administrar ofertas
@endsection

<?php
$fecha_actual = date('Y-m-d');
?>

@section('contenido')
<h1 class="text-center">Ofertas del diario dulce</h1>
<br>
@switch((int)$estado)
  @case(-4)
    <div class="alert alert-danger text-center" role="alert">
      <h5>No tienes acceso a esta función</h5>
    </div>
    @break

  @case(1)
    <div class="alert alert-success text-center" role="alert">
      <h5>Oferta generada con éxito</h5>
    </div>
    @break

  @case(3)
    <div class="alert alert-success text-center" role="alert">
      <h5>¡Diario dulce emitido con éxito!</h5>
    </div>
    @break
@endswitch
<!--Table-->
<table class="table">
    <!--Table head-->
    <thead>
        <tr>
            <th>ID</th>
            <th>Producto</th>
            <th>Descuento (%)</th>
            <th>Inicio de oferta</th>
            <th>Fin de oferta</th>
            <th>Estatus</th>
        </tr>
    </thead>
    <!--Table head-->

    <!--Table body-->
    <tbody>
        @foreach($ofertas as $oferta)
        <tr>
            <th scope="row">
              {{ $oferta->id_ofc }}
            </th>
            <td>
              @foreach($caramelos as $caramelo)
                @if($oferta->fk_car == $caramelo->id_car)
                {{ $caramelo->nombre_car }}
                @break
                @endif
              @endforeach
            </td>
            <td>
              {{ $oferta->descuento_ofe }}
            </td>
            <td>
              @foreach($info_ofe as $info)
                @if($info->id_ofe == $oferta->fk_ofe)
                {{ $info->fecha_ini_ofe }}
                @break
                @endif
              @endforeach
            </td>
            <td>
              @foreach($info_ofe as $info)
                @if($info->id_ofe == $oferta->fk_ofe)
                {{ $info->fecha_fin_ofe }}
                @break
                @endif
              @endforeach
            </td>
            <td>
              @foreach($info_ofe as $info)
                @if($info->id_ofe == $oferta->fk_ofe)
                  @if($info->fecha_ini_ofe <= $fecha_actual && $info->fecha_fin_ofe >= $fecha_actual)
                  <strong style="color:green;">Activa</strong>
                  @else
                  <strong style="color:red;">Inactiva</strong>
                  @endif
                @endif
              @endforeach
            </td>
        </tr>
        @endforeach
    </tbody>
    <!--Table body-->

</table>
<!--Table-->
@endsection
