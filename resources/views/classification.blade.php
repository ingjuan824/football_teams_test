@extends('plantilla');

@section('seccion')


<div class="container my-4">
    <h1 class="display-4">Tabla de clasificación</h1>

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


  

    <table class="table  my-4">
        <thead>
            <tr>
                <th scope="col">Posición</th>
                <th scope="col">Equipo</th>
                <th scope="col">PJ</th>
                <th scope="col">PG</th>
                <th scope="col">PP</th>
                <th scope="col">PE</th>
                <th scope="col">Goles</th>
                <th scope="col">Puntos</th>
            </tr>
        </thead>

        <tbody>
            @foreach($classfication as $index => $team)
            <tr>
                <th scope="row">{{$index+1}}</th>
                <th>{{$team->team_name}}</th>
                <th>{{$team->pj}}</th>
                <th>{{$team->pg}}</th>
                <th>{{$team->pp}}</th>
                <th>{{$team->pe}}</th>
                <th>{{$team->goals}}</th>
                <th>{{$team->points}}</th>
            </tr>

            @endforeach
    </table>
  
    {{-- Esto de arriba crea un paginacion para ir viendo los datos de acuerdo a como hayamos indicado, por ej de 2 en 2
    --}}
</div>


@endsection