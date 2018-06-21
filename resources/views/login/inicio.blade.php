@extends('layouts.app')

@section('titulo')
CandyUcab - Login
@endsection

@section('contenido')

<div class="container-fluid p-5" style="background-color: rgba(0,0,0,0.5);">
  <div class="container">
    <div class="row">
      <div class="col-md-3 col-sm-12">
        <h3></h3>
      </div>
      @if(Auth::guest())
      <div class="col-md-6 col-sm-12 bg-content p-5">
        <form action="{{ url('/login/verificar') }}" role="form" method="post">
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
            <p class="h4 text-center mb-4">Ingresar a CandyUcab</p>
            <div class="md-form">
                <input type="text" name="usuario" id="usuario" class="form-control" required>
                <label for="usuario">Usuario</label>
            </div>

            <div class="md-form">
                <input type="password" name="password" id="password" class="form-control" required>
                <label for="password">Contraseña</label>
            </div>

            <div class="text-center mt-4">
                <button class="btn btn-pink" type="submit">Ingresar</button>
            </div>
        </form>
      </div>
      @endif
      <div class="col-md-3 col-sm-12">
        <h3></h3>
      </div>
    </div>
  </div>
</div>

@endsection
