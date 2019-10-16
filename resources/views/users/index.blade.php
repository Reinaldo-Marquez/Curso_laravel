    @extends('layout');

    @section('title')
    Usuarios
    @endsection

    @section('content')

    <h1 class="mt-5">{{$titulo}}</h1>

    <a href="{{route('create')}}" class="btn btn-info mb-3 float-right">Crear usuario</a>

    @if ($users->isNotEmpty())

    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Email</th>
                <th scope="col">Opciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)

            <tr>
                <th scope="row">{{$user->id}}</th>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>
                    <form action="{{ route('destroy', $user) }}" method="post">

                        {{method_field('delete')}}
                        {{ csrf_field() }}

                        <a href="{{ route('show', $user) }}" class="btn btn-link"><i class="fas fa-user"></i></a>
                        <a href="{{ route('edit', $user) }}" class="btn btn-link"><i class="fas fa-pencil-alt"></i></a>
                        <button type="submit" class="btn btn-link"> <i class="fas fa-trash"></i></button>

                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p>No hay usuarios registrados</p>
    @endif

    @endsection
