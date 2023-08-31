@extends('layouts.app')

@section('content')

<!-- Tabla con clases de Bootstrap para estilo -->
<a class="mb-3 btn btn-primary" href="{{ url('users/create') }}"><i class="fa-solid fa-plus ms-1"></i><b> Agregar</b></a>

<h1>Lista de usuarios</h1>


<table class="table table-bordered table-striped">
    <thead>
        @if (Session::has('msg'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong> {{Session::get('msg')}}</strong>.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        </div>
        @endif
        <tr>
            <!-- Encabezados de las columnas -->
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>Correo</th>
            <th>Acción</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <!-- Datos del primer usuario -->
            @foreach($users as $user)
            <td>{{$user->name}}</td>
            <td>{{$user->surname}}</td>
            <td>{{$user->email}}</td>
            <td class="d-flex ">
                <form action="{{url('users',$user->id)}}" method="POST">
                    @method('GET')
                <button class="btn btn-warning me-1" type="submit"><i class="fas fa-pencil-alt"></i></button>
                </form>
                <form action="{{ url('/users/' . $user->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit"><i class="fas fa-trash-alt"></i></button>
                            </form>
            </td>
        </tr>
        @endforeach


        <!-- Puedes agregar más filas de usuarios aquí -->
    </tbody>
</table>

</div>


@endsection