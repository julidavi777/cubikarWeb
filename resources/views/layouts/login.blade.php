<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Cubikar') }}</title>
    <!-- Enlace al archivo CSS de Bootstrap -->
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <style>
body, html {
    margin: 0;
    padding: 0;
    height: 100%;
    overflow: hidden;
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
}

 
.logo{
    display: flex;
    align-content: center;
    padding: 1 auto;
    height: 200px;
margin: auto;

    
}
.logo img{
    width: 100%;
    margin: auto ;
    margin: center;
    
}
.background-image {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: -1;
}

.background-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.container {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    height: 100%;
}
.chico {
    width: 25vw;
    height: 75vh;
    padding: 20px;
    background-color: rgba(255, 255, 255, 0.9);
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
    font-size: 16px; /* Tamaño de fuente para el contenido dentro de "chico" */
}
.chico form {
    max-width: 300px;
    margin: 0 auto;
}

.titulo {
    font-size: 18px;
    text-align: center;
    margin-bottom: 20px;
}

.form-group {
    margin-bottom: 15px;
}

.form-group label {
    font-weight: bold;
    display: block;
    margin-bottom: 5px;
}

.form-control {
    width: 100%;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 3px;
}

.btn-primary {
    display: block;
    width: 100%;
    padding: 10px;
    text-align: center;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 3px;
    cursor: pointer;
}

.btn-primary:hover {
    background-color: #0056b3;
}

    </style>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">   -->
</head>

<body>

    @yield('content')
    <!-- Enlace al archivo JavaScript de Bootstrap (bundle) -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>