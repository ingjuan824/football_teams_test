<?php

namespace App\Http\Controllers;

use App\Http\Requests\GameRequest;
use App\Models\Games;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use App\Utils\Util;
use Exception;
use Illuminate\Support\Facades\DB;

class GameController extends Controller
{
    /**
     * Funcion que permite crear un partido entre dos equipos.
     * @param $request, objeto con el [payload] proporcionados en la solicitud
     */
    public function store(GameRequest $request)
    {
        try {

            if( $request->local_team_id ==$request->away_team_id )
            throw new Exception('Error : No se puede registar el partido porque los equipos seleccionados son iguales.');

            /// Registramos el partido
            $player = Games::create([
                'local_team' => $request->local_team_id,
                'away_team' => $request->away_team_id,
                'local_goals' => $request->local_goals,
                'away_goals' => $request->away_goals,
                'date' => date("Y-m-d H:i:s")
            ]);

            /// Verificacamos el resultado del partido y procedemos a realizar la respectiva operación
            if ($request->local_goals == $request->away_goals) {
                /// Entra aqui si el partido quedo empatado

                /// Actualizamos la clasificacion del equipo local
                $this->updateClassificationTeam($request->local_team_id, 0, 0, 1, $request->local_goals, 1);

                /// Actualizamos la clasificacion del equipo visitante
                $this->updateClassificationTeam($request->away_team_id, 0, 0, 1, $request->away_goals, 1);
            } else if ($request->local_goals > $request->away_goals) {
                /// Entra aqui si gano el equipo local

                /// Actualizamos la clasificacion del equipo local
                $this->updateClassificationTeam($request->local_team_id, 1, 0, 0, $request->local_goals, 3);

                /// Actualizamos la clasificacion del equipo visitante
                $this->updateClassificationTeam($request->away_team_id, 0, 1, 0, $request->away_goals, 0);
            } else {
                /// Entra aqui si gano el equipo visitante

                /// Actualizamos la clasificacion del equipo local
                $this->updateClassificationTeam($request->local_team_id, 0, 1, 0, $request->local_goals, 0);

                /// Actualizamos la clasificacion del equipo visitante
                $this->updateClassificationTeam($request->away_team_id, 1, 0, 0, $request->away_goals, 3);
            }

            return response(
                [
                    'success' => true,
                    'messages' => ["Partido registrado con éxito."],
                    'data' => $player
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

    /**
     * @param $team_id , hace referencia a el id del equipo
     * @param $pg , hace referencia a cuanto se debe incrementar los partidos ganados
     * @param $pp  , hace referencia a cuanto se debe incrementar los partidos perdidos
     * @param $pe  , hace referencia a cuanto se debe incrementar los partidos empatados
     * @param $goals , hace referencia a cuanto se debe incrementar los partidos jugados
     * @param $points , hace referencia a los puntos que debe recibir el equipo
     * @return void 
     */
    public function updateClassificationTeam($team_id, $pg, $pp, $pe, $goals, $points)
    {
        DB::table('classifications')
            ->where('team_id', $team_id)
            ->update([
                'pj' => DB::raw('pj + 1'),
                'pg' => DB::raw('pg + ' . $pg),
                'pp' => DB::raw('pp + ' . $pp),
                'pe' => DB::raw('pe + ' . $pe),
                'goals' => DB::raw('goals + ' . $goals),
                'points' => DB::raw('points + ' . $points),
            ]);
    }
}
