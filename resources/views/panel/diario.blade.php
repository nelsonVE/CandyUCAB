@extends('layouts.panel')

@section('titulo')
CandyUcab - Diario dulce
@endsection

@section('contenido')
  @if(!$diario)
  <div class="container-fluid bg-white text-center p-5 my-5">
    <h1>No se ha emitido el diario dulce aún</h1><hr>
    <h5>¡No te desanimes! Cada 25 días nuestro personal se encarga de
       traerte las mejores ofertas posibles de nuestros mejores productos.</h5>
  </div>
  @else

  <div class="container-fluid pt-1 pb-5"  style="background-color: rgba(0,0,0,0.5);">
    <div class="container-fluid bg-white text-center p-5 my-5">
      <h1>Diario dulce</h1>
    </div>
    <div class="row">
      @foreach($ofe_car as $oferta)
          @foreach($caramelos as $caramelo)
              @if($oferta->fk_car == $caramelo->id_car)
                @foreach($ofe_inf as $inf)
                  @if($inf->id_ofe == $oferta->fk_ofe)
                  <div class="col-lg-3 col-md-4 pt-4">
                    <div class="card">
                      <img class="card-img-top" src="{!! asset($caramelo->url_car) !!}" style="max-height: 200px;">
                      <div class="card-body">
                        <h4 class="card-title"><a>{{ $caramelo->nombre_car }}</a></h4>
                        <p class="card-text">
                          <h5>{{ $caramelo->desc_car }}</h5><br>
                          Tamaño del dulce: {{ $caramelo->tamanho_car }}<br>
                          Sabor del dulce: {{ $caramelo->sabor_car }}<br>
                          Forma del dulce: {{ $caramelo->forma_car }}<br>
                          Descuento: {{ $oferta->descuento_ofe }}%<br>
                          Precio: {{ ($caramelo->precio_car / 100) * $oferta->descuento_ofe }}
                        </p>
                      </div>
                    </div>
                  </div>
                  @endif
                @endforeach
              @endif
            @endforeach
      @endforeach
    </div>
  </div>
  @endif
@endsection
