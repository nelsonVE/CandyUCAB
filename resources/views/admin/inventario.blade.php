@extends('layouts.admin')

@section('titulo')
CandyUcab - Inventario
@endsection

@section('contenido')
  <div class="container-fluid">
    <div class="row">
      @if(isset($productos))
      @foreach($productos as $producto)
      <div class="col-md-12 col-sm-12 alert alert-danger">
        <strong>Zona {{ $producto['letra_zon'] }} pasillo {{ $producto['pasillo'] }}</strong>
        Existe un stock total de {{ $producto['cantidad'] }}. Es necesaria la reposición.
      </div>
      @endforeach
      <button type="button" name="button" class="btn btn-primary" onclick="location.href='/admin/reponer/{{ $productos[0]['tienda'] }}';" style="width:100%;">Reponer inventario</button>
      @else
      <div class="col-md-12 col-sm-12 alert alert-success">
        <strong>Esta tienda no posee zonas que necesiten reposición</strong>
      </div>
      @endif
    </div>
  </div>
@endsection
