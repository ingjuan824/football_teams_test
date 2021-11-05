@extends('plantilla');

@section('seccion')


<div class="container my-4">
    <h1 class="display-4">Jugadores</h1>

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


    <form action="{{route('players.store')}}" method="POST">
        {{-- Agg el token de seguridad --}}
        @csrf

        @if ($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
        @endif


        {{-- Datos del registro --}}
        <input type="text" name="name" placeholder="Nombre del jugador" class="form-control mb-2"
            value="{{ old('name') }}">

        {{-- Equipo --}}
        <select name="team_id" class="form-select form-control mb-2" aria-label="Default select example">
            <option selected>Equipo</option>
            @foreach($teams as $team)
            <option value="{{$team->id}}" {{ old('team_id')==$team->id ? 'selected' : '' }}>{{$team->name}}
            </option>
            @endforeach
        </select>

        <input type="number" name="age" placeholder="Edad del jugador" class="form-control mb-2"
            value="{{ old('age') }}">
        <input type="number" name="tr" placeholder="Tarjetas rojas del jugador" class="form-control mb-2"
            value="{{ old('tr') }}">
        <input type="number" name="ta" placeholder="Tarjetas amarillas del jugador" class="form-control mb-2"
            value="{{ old('ta') }}">
        <input type="number" name="goals" placeholder="Goles del jugador" class="form-control mb-2"
            value="{{ old('goals') }}">
        <input type="number" name="pj" placeholder="Partidos jugados del jugador" class="form-control mb-2"
            value="{{ old('pj') }}">
        <input type="number" name="salary" placeholder="Sueldo del jugador" class="form-control mb-2"
            value="{{ old('salary') }}">







        <button type="submit" class="btn btn-dark btn-block">Crear Jugador </button>
    </form>


    <table class="table  my-4">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Equipo</th>
                <th scope="col">TR</th>
                <th scope="col">TA</th>
                <th scope="col">Goles</th>
                <th scope="col">PJ</th>
                <th scope="col">Sueldo</th>
            </tr>
        </thead>

        <tbody>
            @foreach($players as $player)
            <tr>
                <th scope="row">{{$player->id}}</th>
                <th>{{$player->name}}</th>
                <th>{{$player->team_name}}</th>
                <th>{{$player->tr}}</th>
                <th>{{$player->ta}}</th>
                <th>{{$player->goals}}</th>
                <th>{{$player->pj}}</th>
                <th>{{number_format($player->salary)}}</th>
            </tr>

            @endforeach
    </table>
    {{$players->links()}}
    {{-- Esto de arriba crea un paginacion para ir viendo los datos de acuerdo a como hayamos indicado, por ej de 2 en 2
    --}}
</div>


@endsection