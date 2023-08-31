@extends('layouts.login')
@section('content')



<div class="background-image">
    <img src="{{asset('assets/icon/fondocubikar.jpeg')}}" alt="Imagen de fondo">
</div>
<div class="container">
  
    <div class="chico">
      <div class="logo">
        <img src="{{ asset('./assets/icon/Logo_Cubikar_5.png') }}" width="100px" alt="">
      </div>
      <br>
      <h2 class="titulo">Ingresa tu contraseña y correo</h2>
        <form method="POST" action="{{url('login')}}">
          @csrf
          @method('POST')
            <div class="form-group">
                <label for="email">Correo Electrónico</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="contrasena">Contraseña</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
        </form>
        @if($errors->has('login'))
        <div class="alert alert-danger">{{ $errors->first('login') }}</div>
    @endif
    </div>
</div>