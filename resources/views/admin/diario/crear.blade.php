@extends('layouts.admin')

@section('titulo')
CandyUcab - Crear oferta
@endsection

@section('contenido')
<h1>Creación de ofertas</h1>
<div class="col-md-12 col-sm-12 bg-content p-5">
  <form action="{{ url('/admin/diario/oferta/validar') }}" role="form" method="post">
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
      <br> <br>
      Porcentaje de descuento: <br>
      <div class="md-form">
          <input type="number" min="0" max="99" value="0" name="descuento" id="descuento" class="form-control" required>
      </div>
      <br> <br>
      Producto a ofertar
      <br>
      <div class="md-form">
        <select class="form-control form-control-sm" name="caramelo">
          @foreach($caramelos as $caramelo)
          <option value="{{ $caramelo->id_car }}">{{ $caramelo->nombre_car }} sabor: {{ $caramelo->sabor_car }}</option>
          @endforeach
        </select>
      </div>
      <br>
      <div class="text-center mt-4">
          <button class="btn btn-primary" type="submit">Crear oferta</button>
      </div>
  </form>
</div>
@endsection
