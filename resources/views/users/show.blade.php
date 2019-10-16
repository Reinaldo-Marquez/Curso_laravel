@extends('layout');

@section('title')
        Detalles
    @endsection

@section('content')

<h1 class="mt-5">Usuario # {{$user->id}}</h1>  
<p><strong>Nombre del usuario:</strong> {{$user->name}}</p>
<p><strong>Email del usuario:</strong> {{$user->email}}</p>
<a href="{{route('user')}}">Volver al inicio</a>

@endsection
