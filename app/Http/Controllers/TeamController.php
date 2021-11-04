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
            $team = Team::create([
                'name' => $request->name,
                'division_id' => $request->division_id,
                'city_id' => $request->city_id,
                'number_players' => $request->number_players,
            ]); 

            // $position = Classification::latest('position')->first();
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
            ], HttpResponse::HTTP_OK);
        }
    }
}
