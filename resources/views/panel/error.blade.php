@extends('layouts.panel')

@section('titulo')
CandyUcab - Error
@endsection

@section('contenido')
  @switch($error)
    @case(1)
      <div class="col-md-12 col-sm-12 mt-5 mb-5 z-depth-1 p-5 text-center alert alert-danger">
        <h2><strong>¡Le debemos una disculpa!</strong></h2><br><br>
        <h5>La cantidad de productos que usted solicitó no está disponible en la
            tienda seleccionada previamente.</h5>
      </div>
      @break
    @case(2)
      <div class="col-md-12 col-sm-12 mt-5 mb-5 z-depth-1 p-5 text-center alert alert-danger">
        <h2><strong>¡Usted no posee tarjeta de crédito afiliada!</strong></h2><br><br>
        <h5>Para afiliar una tarjeta de crédito, necesita ir a su cuenta, configuración
            y, seguidamente, rellenar la información solicitada, una vez hecho eso, intente
            realizar el pago nuevamente.</h5>
      </div>
      @break
    @case(3)
      <div class="col-md-12 col-sm-12 mt-5 mb-5 z-depth-1 p-5 text-center alert alert-danger">
        <h2><strong>¡Usted no posee puntos!</strong></h2><br><br>
        <h5>Para poder comprar utilizando los puntos de CandyUcab necesita realizar
            compras en nuestras tiendas en físico, con lo cual irá acumulando puntos question
            que le servirán para comprar productos por nuestra página web.</h5>
      </div>
      @break
    @case(4)
      <div class="col-md-12 col-sm-12 mt-5 mb-5 z-depth-1 p-5 text-center alert alert-success">
        <h2><strong>¡Pedido realizado!</strong></h2><br><br>
        <h5>Se ha realizado el pedido a la tienda con éxito.</h5>
      </div>
      @break
    @case(5)
      <div class="col-md-12 col-sm-12 mt-5 mb-5 z-depth-1 p-5 text-center alert alert-danger">
        <h2><strong>¡Tus puntos no son suficientes para poder pagar el pedido!</strong></h2><br><br>
        <h5>Hemos reunido los puntos acumulados que posees junto con su valor y hemos notado
            que no son suficientes para poder cancelar el monto total de tu pedido. Te invitamos
            a que compres en nuestros establecimientos para ir acumulando puntos y así poder
            utilizarlos de manera exitosa en nuestra página web.</h5>
      </div>
      @break
  @endswitch
@endsection
