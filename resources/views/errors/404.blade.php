@extends('layout');

@section('title')
        Error 404
    @endsection

@section('content')
    <h1 class="mt-5">Usuario no encontrado</h1>
    <a href="{{route('user')}}">Volver al inicio</a>
@endsection