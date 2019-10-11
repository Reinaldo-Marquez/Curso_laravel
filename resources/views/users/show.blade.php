@extends('layout');

@section('title')
        Detalles
    @endsection

@section('content')

<h1 class="mt-5">Usuario # {{$user->id}}</h1>  
<p>Nombre del usuario: {{$user->name}}</p>
<p>Email del usuario: {{$user->email}}</p>
<a href="{{route('user')}}">Volver al inicio</a>

@endsection
