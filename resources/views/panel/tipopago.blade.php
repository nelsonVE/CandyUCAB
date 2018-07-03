@extends('layouts.panel')

@section('titulo')
CandyUcab - Seleccionar tipo de pago
@endsection

@section('contenido')
<div class="container-fluid p-5" style="background-color: rgba(0,0,0,0.5);">
  <div class="container">
    <div class="row text-center ">
      <div class="col-md-3 col-sm-12">
        <h3></h3>
      </div>
      <div class="col-md-6 col-sm-12 t-left bg-content p-5" style="border-radius:8px;">
        <img src="https://www.shareicon.net/data/128x128/2016/11/22/854909_business_512x512.png" alt="">
        <br><br><h3>Selecciona tu tipo de pago:</h3><br>
        <form class="" action="{{ url('panel/tienda/candy/carrito/procesar') }}" method="post">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <select class="form-control form-control-sm" name="tipopago">
              <option value="1">Puntos</option>
              <option value="2">Tarjeta de crédito</option>
          </select>
          <br>
        <button type="submit" class="btn btn-pink" style="width:100%">Seleccionar</button>
        </form>
      </div>
      <div class="col-md-3 col-sm-12">
        <h3></h3>
      </div>
    </div>
  </div>
</div>
@endsection
