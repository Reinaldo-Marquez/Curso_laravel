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

    <div class="form-group">
        <label for="name">Ingrese su nombre</label>
        <input type="text" class="form-control" name="name" id="name" value="{{old('name', $user->name)}}"
            placeholder="Reinaldo Marquez">
    </div>
    <div class="form-group">
        <label for="name">Ingrese su correo</label>
        <input type="email" class="form-control" name="email" id="email" value="{{old('email', $user->email)}}"
            placeholder="reinaldo@reinaldo.com">
    </div>
    <div class="form-group">
        <label for="name">Ingrese su contraseña</label>
        <input type="password" class="form-control" name="password" id="password" placeholder="Mayor a 8 caracteres">
    </div>

    <button type="submit" class="btn btn-primary">Actualizar usuario</button>
</form>

<p><a href="{{route('user')}}">Volver al inicio</a></p>


@endsection
