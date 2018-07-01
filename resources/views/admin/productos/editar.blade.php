@extends('layouts.admin')

@section('titulo')
CandyUcab - Editar productos
@endsection

@section('contenido')
<h1>Edición de productos (#{{ $producto->id_car }})</h1>
<div class="col-md-12 col-sm-12 bg-content p-5">
  <form action="/admin/productos/{{ $producto->id_car }}/guardar" role="form" method="post">
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
      <div class="md-form">
          <input value="{{ $producto->nombre_car }}" type="text" name="nombre" id="nombre" class="form-control" required>
          <label for="nombre">Nombre del producto:</label>
      </div>
      <div class="md-form">
          <input value="{{ $producto->desc_car }}" type="text" name="desc" id="desc" class="form-control" required>
          <label for="desc">Descripción del producto:</label>
      </div>
      <div class="md-form">
          <input value="{{ $producto->forma_car }}" type="text" name="forma" id="forma" class="form-control" required>
          <label for="forma">Forma del producto:</label>
      </div>
      <div class="md-form">
          <input value="{{ $producto->tamanho_car }}" type="text" name="tamanho" id="tamanho" class="form-control" required>
          <label for="tamanho">Tamaño del producto:</label>
      </div>
      <div class="md-form">
          <input value="{{ $producto->sabor_car }}" type="text" name="sabor" id="sabor" class="form-control" required>
          <label for="sabor">Sabor del producto:</label>
      </div>
      <div class="md-form">
          <input value="{{ $producto->url_car }}" type="text" name="url" id="url" class="form-control" required>
          <label for="url">URL de miniatura del producto:</label>
      </div>
      <div class="md-form">
          <input value="{{ $producto->precio_car }}" type="number" min="1" name="precio" id="nombre" class="form-control" required>
          <label for="precio">Precio del producto:</label>
      </div>

      <div class="text-center mt-4">
          <button class="btn btn-primary" type="submit">Editar</button>
      </div>
  </form>
</div>
@endsection
