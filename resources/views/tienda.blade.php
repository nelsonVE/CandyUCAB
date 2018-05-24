@extends('layouts.app')

@section('contenido')
<div class="container-fluid p-5" style="background-color: rgba(0,0,0,0.5);">
  <div class="container">
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
    <div class="row text-center ">
      <div class="col-md-3 col-sm-12">
        <h3></h3>
      </div>
      <div class="col-md-3 col-sm-12 t-left bg-content p-5 waves-effect">
        <img src="{!! asset('img/shop.png') !!}" width="128" height="128"> <hr>
        <h4>CandyShop</h4>
      </div>
      <div class="col-md-3 col-sm-12 t-right bg-content p-5 waves-effect">
        <img src="{!! asset('img/mini-shop.png') !!}" width="128" height="128"> <hr>
        <h4>Mini CandyShop</h4> <br>
      </div>
      <div class="col-md-3 col-sm-12">
        <h3></h3>
      </div>
    </div>
  </div>
</div>
@endsection
