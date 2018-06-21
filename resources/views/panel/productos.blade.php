@extends('layouts.panel')

@section('contenido')
<div class="container-fluid pt-1 pb-5"  style="background-color: rgba(0,0,0,0.5);">
  <div class="row">
    @foreach($productos as $producto)
    <div class="col-md-2 pt-4">
      <div class="card">
        <img class="card-img-top" src="{!! asset($producto->url_car) !!}" style="max-height: 200px;">
        <div class="card-body">
          <h4 class="card-title"><a>{{ $producto->nombre_car }}</a></h4>
          <p class="card-text">
            <h5>{{ $producto->desc_car }}</h5><br>
            Tamaño del dulce: {{ $producto->tamanho_car }}<br>
            Sabor del dulce: {{ $producto->sabor_car }}<br>
            Forma del dulce: {{ $producto->forma_car }}
          </p>
        </div>
      </div>
    </div>
    @endforeach
  </div>
</div>
@endsection
