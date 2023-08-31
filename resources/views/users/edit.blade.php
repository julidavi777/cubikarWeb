@extends('layouts.app')
@section('content')

<form action="{{url('/users')}}" method="patch" enctype="multipart/form-data">
    @method('patch')
    @csrf

@include('users.form', ['mode'=>'Editar', 'action'=>''])

@endsection