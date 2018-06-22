@extends('layouts.panel')

@section('titulo')
CandyUcab - Agregar al carrito
@endsection

@section('contenido')

<div class="container-fluid"  style="background-color: rgba(0,0,0,0.5);">
  <div class="container pt-5 pb-5">
    <!--Table-->
    <table class="table bg-white table-hover w-auto" style="border-radius: 2px;">

      <!--Table head-->
      <thead>
          <tr>
              <th></th>
              <th>Nombre del producto</th>
              <th>Sabor</th>
              <th>Precio</th>
              <th>Cantidad</th>
          </tr>
      </thead>
      <!--Table head-->

      <!--Table body-->
      <tbody>
          <tr>
              <td> <img src="{!! asset($productos[$id_car]->url_car) !!}" style="max-width:50px; max-height:50px;"> </td>
              <td>{{ $productos[$id_car]->nombre_car }}</td>
              <td>{{ $productos[$id_car]->sabor_car }}</td>
              <td>{{ $productos[$id_car]->precio_car }}</td>
              <td> <input type="number" name="cantidad" value="1" min="1" style="width:3em; text-align:center;"></td>
          </tr>
          <tr>
              <th scope="row">2</th>
              <td>Jacob</td>
              <td>Thornton</td>
              <td>@fat</td>
          </tr>
          <tr>
              <th scope="row">3</th>
              <td colspan="2">Larry the Bird</td>
              <td>@twitter</td>
          </tr>
      </tbody>
      <!--Table body-->

    </table>
  </div>
</div>
<!--Table-->
@endsection
