@extends('layouts.app')
@section('content')

<form action="{{url('/employees')}}" method="post" enctype="multipart/form-data">
    @csrf

@include('employees.form', ['mode'=>'Crear', 'action'=>''])

@endsection