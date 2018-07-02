@extends('layouts.panel')

@section('titulo')
CandyUcab - Agregar al carrito
@endsection

@section('contenido')

<div class="container-fluid"  style="background-color: rgba(0,0,0,0.5);">
  <div class="container pt-5 pb-5 bg-white text-center">
    <!--Table-->
      <form action="{{ url('/panel/tienda/candy/procesar') }}" role="form" method="post">
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
          <input type="hidden" name="producto" value="{{ $id_car }}">
          <!--Table head-->
          <table class="table table-hover w-auto" style="border-radius: 2px;">
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
          </tbody>
          <!--Table body-->
      </table>
      <button type="submit" class="btn btn-pink" style="width:100%">Agregar al carrito</button>

    </form>
  </div>
</div>
<!--Table-->
@endsection
