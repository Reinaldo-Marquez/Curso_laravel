    @extends('layout');

    @section('title')
        Usuarios
    @endsection

    @section('content')
        
    <h1 class="mt-5">{{$titulo}}</h1>
    
    <a href="{{route('create')}}">Crear usuario</a>

    <ul>
        @forelse ($users as $user)
    <li>{{$user->name}} - {{$user->email}} 
        <a href="{{ route('show', $user) }}">Detalles</a> | 
        <a href="{{ route('edit', $user) }}">editar</a> | 
    <form action="{{ route('destroy', $user) }}" method="post" >
        {{method_field('delete')}}
        {{ csrf_field() }}

        <button> Eliminar </button>

    </form>
    </li> 
        @empty
            <p>No hay usuarios registrados</p>            
        @endforelse
    </ul>

    @endsection
    

