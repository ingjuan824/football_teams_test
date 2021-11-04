<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTeamRequest;
use App\Models\Classification;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use App\Utils\Util;
use Exception;

class TeamController extends Controller
{
    /**
     * Funcion que permite crear un equipo de futbol.
     * @param $request, objeto con el [payload] proporcionados en la solicitud
     */
    public function store(StoreTeamRequest $request)
    {
        try {
            /// Creamos el equipo
            $team = Team::create([
                'name' => $request->name,
                'division_id' => $request->division_id,
                'city_id' => $request->city_id,
                'number_players' => $request->number_players,
            ]);

            /// Registramos  a el equipo en la tabla de posiciones 
            ///y automaticamente le asignamos la ultima posicion
            Classification::create([
                'team_id' =>  $team->id,
                'pj' => 0,
                'pg' => 0,
                'pp' => 0,
                'goals' => 0,
                'points' => 0,
                'status' => 0
            ]);
            return response(
                [
                    'success' => true,
                    'messages' => ["Equipo creado con éxito."],
                    'data' => $team
                ],
                HttpResponse::HTTP_OK
            );
        } catch (\Throwable $e) {
            return response([
                'success' => false,
                'message' => [Util::throwExceptionMessage($e)],
                'data' => []
            ], HttpResponse::HTTP_BAD_REQUEST);
        }
    }
    /**
     * Funcion que permite listar todos los equipos registrados en el sistema
     * @param $request['per_page'],Cantidad de registros por pagina
     */
    public function index()
    {
        try {
            $per_page = \Request::get('per_page') ?: 10;

            $teams = Team::select('teams.*', 'ct.name as city_name', 'dv.name as division_name')
            ->join('cities as ct', 'ct.id', '=', 'teams.city_id')
            ->join('divisions as dv', 'dv.id', '=', 'teams.division_id')
            ->paginate($per_page);
            
            if (!$teams) throw new Exception('Error : Lo sentimos no hay equipos registrados.');

            return response(
                [
                    'success' => true,
                    'messages' => ["Listado de equipos."],
                    'data' => $teams
                ],
                HttpResponse::HTTP_OK
            );
        } catch (\Exception $e) {
            return response([
                'success' => false,
                'message' => [Util::throwExceptionMessage($e)],
                'data' => []
            ], HttpResponse::HTTP_BAD_REQUEST);
        }
    }
}
