@extends('layouts.app')
@section('content')

<form action="{{url('/employees')}}" method="patch" enctype="multipart/form-data">
    @method('patch')
    @csrf

@include('employees.form', ['mode'=>'Editar', 'action'=>''])

@endsection