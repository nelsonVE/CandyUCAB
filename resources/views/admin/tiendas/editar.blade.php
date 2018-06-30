@extends('layouts.admin')

@section('titulo')
CandyUcab - Editar tiendas
@endsection

@section('contenido')
<h1>Edición de tienda (#{{ $tienda->id_tie }})</h1>
<div class="col-md-12 col-sm-12 bg-content p-5">
  <form action="/admin/tiendas/{{ $tienda->id_tie }}/guardar" role="form" method="post">
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
          <input value="{{ $tienda->nombre_tie }}" type="text" name="nombre" id="nombre" class="form-control" required>
          <label for="nombre">Nombre de la tienda:</label>
      </div>

      <div class="text-center mt-4">
          <button class="btn btn-primary" type="submit">Editar</button>
      </div>
  </form>
</div>
@endsection
