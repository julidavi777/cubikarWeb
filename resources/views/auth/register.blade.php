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
        <form>
            <div class="form-group">
                <label for="correo">Correo Electrónico</label>
                <input type="email" id="correo" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="contrasena">Contraseña</label>
                <input type="password" id="contrasena" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
        </form>
    </div>
</div>