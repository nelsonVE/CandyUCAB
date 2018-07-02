@extends('layouts.panel')

@section('titulo')
CandyUcab - Carrito
@endsection

@section('contenido')

<?php
  $total_precio = 0;
  $total_productos = 0;
  $descuento = 0;
?>

@if(!$productos)
<div class="container-fluid bg-white text-center p-5 my-5">
  <h1>No posees productos agregados al carrito de compras</h1><hr>
  <h5>¿Deseas realizar alguna compra? Dirígete a nuestra sección
      'tienda', selecciona la tienda de tu preferencia y ¡a comprar!</h5>
</div>
@else
<div class="container-fluid pt-1 py-5 bg-white"  style="background-color: rgba(0,0,0,0.5);">
  <div class="row">
    <table class="table table-hover w-auto text-center" style="border-radius: 2px;">
        <thead>
            <tr>
                <th></th>
                <th>Nombre del producto</th>
                <th>Sabor</th>
                <th>Precio</th>
                <th>Cantidad</th>
            </tr>
        </thead>
        <tbody>
        @for($i = 0; $i < count($productos); $i++)
          @foreach($caramelos as $caramelo)
            @if($productos[$i]['id_car'] == $caramelo->id_car)
              <tr>
                  <td> <img src="{!! asset($caramelo->url_car) !!}" style="max-width:50px; max-height:50px;"> </td>
                  <td>{{ $caramelo->nombre_car }}</td>
                  <td>{{ $caramelo->sabor_car }}</td>
                  <td>
                    <?php
                    $precio_producto = $caramelo->precio_car;
                    $descuento = 0;
                    ?>
                    @if($ofe_inf && $ofe_car)
                      @foreach($ofe_inf as $inf)
                        @foreach($ofe_car as $oferta)
                          @if($oferta->fk_ofe == $inf->id_ofe && $oferta->fk_car == $caramelo->id_car)
                          <?php
                          $precio_producto = ($oferta->descuento_ofe * $caramelo->precio_car) / 100;
                          $precio_producto = $caramelo->precio_car - $precio_producto;
                          $descuento = $oferta->descuento_ofe;
                          ?>
                          @endif
                        @endforeach
                      @endforeach
                    @endif
                    {{ $precio_producto }}
                    @if($descuento > 0)
                      <strong style="color:green">(-{{ $descuento }}%)</strong>
                    @endif
                  </td>
                  <td>{{ $productos[$i]['cantidad'] }}</td>
                  <?php
                  $total_precio += $precio_producto * $productos[$i]['cantidad'];
                  $total_productos += $productos[$i]['cantidad'];
                  ?>
              </tr>
            @endif
          @endforeach
        @endfor
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td><strong>Total: {{ $total_precio }}</strong></td>
            <td><strong>{{ $total_productos }}</strong></td>
        </tr>
      </tbody>
      <!--Table body-->
    </table>
    <button type="button" class="btn btn-pink" onclick="window.location='/panel/tienda/candy/carrito/procesar';" style="width:100%">Procesar la compra</button>
    <button type="button" class="btn btn-green" onclick="window.location='/panel/tienda/candy/carrito/presupuesto';" style="width:100%">Realizar presupuesto</button>
  </div>
</div>
@endif
@endsection
