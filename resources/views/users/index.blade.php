    @extends('layout');

    @section('title')
        Usuarios
    @endsection

    @section('content')
        
    <h1 class="mt-5">{{$titulo}}</h1>
    
    <a href="{{route('create')}}">Crear usuario</a>

    <ul>
        @forelse ($users as $user)
    <li>{{$user->name}} - {{$user->email}} <a href="{{ route('show', ['user' => $user->id]) }}">Detalles</a></li> 
        @empty
            <p>No hay usuarios registrados</p>            
        @endforelse
    </ul>

    @endsection
    

