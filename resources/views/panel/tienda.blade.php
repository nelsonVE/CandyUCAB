@extends('layouts.panel')

@section('titulo')
CandyUcab - Tienda
@endsection

@section('contenido')
<div class="container-fluid p-5" style="background-color: rgba(0,0,0,0.5);">
  <div class="container">
    <div class="row text-center ">
      <div class="col-md-3 col-sm-12">
        <h3></h3>
      </div>
      <div class="col-md-6 col-sm-12 t-left bg-content pt-5">
        <img src="{!! asset('img/mini-shop.png') !!}" width="128" height="128">
        <br> <br>  <h3>Selecciona tu tienda:</h3> <br>
        <form class="" action="{{ url('panel/tienda/sitio') }}" method="post">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <select class="form-control form-control-sm" name="sel_tienda">
            <?php
            foreach($tiendas as $tienda){
              echo '<option value="'.$tienda->id_tie.'">'.$tienda->nombre_tie.'</option>';
            }
            ?>
          </select>
          <button type="submit" class="btn btn-pink">Ingresar</button>
        </form>
      </div>
      <div class="col-md-3 col-sm-12">
        <h3></h3>
      </div>
    </div>
    <div class="row text-center">
      <div class="col-md-3 col-sm-12">
        <h3></h3>
      </div>
      <div class="col-md-6 col-sm-12 bg-content p-5 t-header">
        <h1>Nuestra tienda</h1> <hr>
        <p class="text-justify">Candy Shop es una visita obligada para todos aquellos que sueñan con
          vivir en el mundo de Willy Wonka y que sienten un placer inmenso a la
          hora de comer caramelos. Candy Shop es la tienda de caramelos más
          grande de América Latina. En las tiendas Mini Candy Shop UCAB los clientes
          pueden realizar sus compras al igual que en Candy
          Shop, solo que son pequeños espacios donde ofrecemos
          todos nuestros productos pero en menor cantidad.</p>
      </div>
      <div class="col-md-3 col-sm-12">
        <h3></h3>
      </div>
    </div>
  </div>
</div>
@endsection
