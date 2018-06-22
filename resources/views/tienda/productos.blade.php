@extends('layouts.panel')

@section('titulo')
CandyUcab - Tienda
@endsection

@section('contenido')
<div class="container-fluid"  style="background-color: rgba(0,0,0,0.5);">
  <div class="row pt-5 pb-5">
    @foreach($disponibles as $disponible)
    <div class="col-md-2 pt-4">
      <div class="card">
        <img class="card-img-top" src="{!! asset($producto->url_car) !!}" style="max-height: 200px;">
        <div class="card-body">
          <h4 class="card-title"><a>{{ $producto->nombre_car }}</a></h4>
          <p class="card-text">
            <h5>{{ $productos[$disponible->fk_car]->desc_car }}</h5><br>
            Tamaño del dulce: {{ $productos[$disponible->fk_car]->tamanho_car }}<br>
            Sabor del dulce: {{ $productos[$disponible->fk_car]->sabor_car }}<br>
            Forma del dulce: {{ $productos[$disponible->fk_car]->forma_car }}
            <br><br>
            <h4>Precio: {{ $productos[$disponible->fk_car]->precio_car }}</h4>
          </p>
        </div>
        <button type="button" class="btn btn-pink" onclick="window.location='/panel/tienda/candy/agregar/{{ $producto->id_car }}';">Agregar al carrito</button>
      </div>
    </div>
    @endforeach
  </div>
</div>
@endsection
