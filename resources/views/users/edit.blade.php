@extends('layout');

@section('title')
Editar Usuario
@endsection

@section('content')

<h1 class="mt-5">Editar Usuario</h1>

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{url("/usuarios/{$user->id}")}}" method="post">
    {{method_field('PUT')}}
    {{ csrf_field() }}

    <label for="name">Ingrese su nombre</label>
    <input type="text" name="name" id="name" value="{{old('name', $user->name)}}" placeholder="Reinaldo Marquez">

    <br>

    <label for="name">Ingrese su correo</label>
    <input type="email" name="email" id="email" value="{{old('email', $user->email)}}" placeholder="reinaldo@reinaldo.com">

    <br>

    <label for="name">Ingrese su contraseña</label>
    <input type="password" name="password" id="password" placeholder="Mayor a 8 caracteres">

    <br>

    <button type="submit">Actualizar usuario </button>
</form>

<p><a href="{{route('user')}}">Volver al inicio</a></p>


@endsection
