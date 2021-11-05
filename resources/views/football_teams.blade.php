@extends('plantilla');

@section('seccion')


<div class="container my-4">
    <h1 class="display-4">Equipos</h1>

    @if (session('mensaje'))
    <div class="alert alert-success">
        {{session('mensaje')}}

    </div>

    @endif

    @if (session('mensajeEliminar'))
    <div class="alert alert-danger">
        {{session('mensajeEliminar')}}

    </div>

    @endif


    <form action="{{route('teams.store')}}" method="POST">
        {{-- Agg el token de seguridad --}}
        @csrf

        @if ($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
        @endif
        {{-- @error('name')
        <div class="alert alert-danger">

            El nombre es obligatoriozzzz
        </div>
        @enderror
        --}}

        <input type="text" name="name" placeholder="nombre" class="form-control mb-2" value="{{ old('name') }}">
        <input type="number" name="number_players" placeholder="número de jugadores" class="form-control mb-2"
            value="{{ old('number_players') }}">

        {{-- Ciudad del equipo --}}
        <select name="city_id" class="form-select form-control mb-2" aria-label="Default select example">
            <option selected>Selecciona la ciudad del equipo</option>
            @foreach($cities as $city)
            <option value="{{$city->id}}" {{ old('city_id') == 1 ? 'selected' : '' }}>{{$city->name}}</option>
            @endforeach
        </select>

        {{-- Division del equipo --}}
        <select name="division_id" class="form-select form-control mb-2" aria-label="Default select example">
            <option selected>Selecciona la divsión del equipo</option>
            @foreach($divisions as $dv)
            <option value="{{$dv->id}}" {{ old('division_id') == 1 ? 'selected' : '' }} >{{$dv->name}}</option>
            @endforeach
        </select>



        <button type="submit" class="btn btn-dark btn-block">Agregar Equipo </button>
    </form>


    <table class="table  my-4">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Division</th>
                <th scope="col">Ciudad</th>
                <th scope="col">Número de jugadores</th>
            </tr>
        </thead>

        <tbody>
            @foreach($teams as $team)
            <tr>
                <th scope="row">{{$team->id}}</th>
                {{-- <th>
                    <a href="{{route('notas.detalle', $item)}}"> {{$item->nombre}}</a>
                </th> --}}
                <th>{{$team->name}}</th>
                <th>{{$team->division_name}}</th>
                <th>{{$team->city_name}}</th>
                <th>{{$team->number_players}}</th>


            </tr>

            @endforeach
    </table>
    {{$teams->links()}}
    {{-- Esto de arriba crea un paginacion para ir viendo los datos de acuerdo a como hayamos indicado, por ej de 2 en 2
    --}}
</div>


@endsection