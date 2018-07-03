@extends('layouts.panel')

@section('contenido')
<div class="container-fluid p-5" style="background-color: rgba(0,0,0,0.5);">
  <div class="row">
    <div class="col-md-2 col-sm-12 bg-white p-5 text-center">
      <h4>Configuración</h4>
    </div>
    <div class="col-md-7 col-sm-12 bg-white p-5 ml-3">
      <h1 class="text-center">Tarjeta de crédito</h1><hr> <br>
      <img src="{!! asset('img/pago.svg') !!}" style="width:20%; height:20%;">
      <form class="" action="{{ url('panel/configuracion/guardar') }}" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <br>
        <select class="form-control form-control-sm" name="tipo_cre">
            <option value="1">Mastercard</option>
            <option value="1">VISA</option>
        </select>
        <div class="md-form">
            <input type="text" name="numero" id="numero" class="form-control" required>
            <label for="numero">Número de tarjeta de crédito</label>
        </div>
        <div class="md-form">
            <input type="text" name="digitos" id="digitos" class="form-control" required>
            <label for="digitos">Últimos tres dígitos</label>
        </div>
        <br>
        <h4>Fecha de vencimiento</h4>
        <br>
        <select class="form-control form-control-sm" name="mes_venc">
            @for($i = 1; $i < 13; $i++)
            <option value="{{$i}}">{{ $i }}</option>
            @endfor
        </select>
        <select class="form-control form-control-sm" name="anho_venc">
          @for($i = 2018; $i < 2030; $i++)
          <option value="{{$i}}">{{ $i }}</option>
          @endfor
        </select>
        <br>
        <button type="submit" class="btn btn-pink" style="width:100%;">Guardar</button>
        <br><br><br>
      </form>
    </div>
  </div>
</div>
@endsection
