@extends('plantilla');

@section('seccion')


<div class="container my-4">
    <h1 class="display-4">Partidos</h1>

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


    <form action="{{route('games.store')}}" method="POST">
        {{-- Agg el token de seguridad --}}
        @csrf

        @if ($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
        @endif



        {{-- Equipo Local --}}
        <select name="local_team_id" class="form-select form-control mb-2" aria-label="Default select example">
            <option selected>Equipo local</option>
            @foreach($teams as $team)
            <option value="{{$team->id}}" {{ old('local_team_id')==$team->id ? 'selected' : '' }}>{{$team->name}}
            </option>
            @endforeach
        </select>
        {{-- Equipo visitante --}}
        <select name="away_team_id" class="form-select form-control mb-2" aria-label="Default select example">
            <option selected>Equipo local</option>
            @foreach($teams as $team)
            <option value="{{$team->id}}" {{ old('away_team_id')==$team->id ? 'selected' : '' }}>{{$team->name}}
            </option>
            @endforeach
        </select>


        <input type="number" name="local_goals" placeholder="Goles del equipo local" class="form-control mb-2"
            value="{{ old('away_goals') }}">
        <input type="number" name="away_goals" placeholder="Goles del equipo visitante" class="form-control mb-2"
            value="{{ old('away_goals') }}">



        <button type="submit" class="btn btn-dark btn-block">Registrar Partido </button>
    </form>


    <table class="table  my-4">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Fecha</th>
                <th scope="col">Equipo Local</th>
                <th scope="col">Equipo Visitante</th>
                <th scope="col">Goles equipo local</th>
                <th scope="col">Goles equipo visitante</th>
            </tr>
        </thead>

        <tbody>
            @foreach($games as $game)
            <tr>
                <th scope="row">{{$game->id}}</th>
                <th>{{$game->date}}</th>
                <th>{{$game->team_local}}</th>
                <th>{{$game->team_away}}</th>
                <th>{{$game->local_goals}}</th>
                <th>{{$game->away_goals}}</th>
            </tr>

            @endforeach
    </table>
    {{$games->links()}}
    {{-- Esto de arriba crea un paginacion para ir viendo los datos de acuerdo a como hayamos indicado, por ej de 2 en 2
    --}}
</div>


@endsection