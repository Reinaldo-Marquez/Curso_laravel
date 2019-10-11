@extends('layout');

@section('title')
        Crear Usuario
    @endsection

@section('content')

<h1 class="mt-5">Crear Usuario</h1>  

<form action="{{route('store')}}" method="POST">
    {{ csrf_field() }}

    <button type="submit">Crear usuario nuevo</button>
</form>

<p><a href="{{route('user')}}">Volver al inicio</a></p>


@endsection
