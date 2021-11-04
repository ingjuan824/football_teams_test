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
            /// Registramos el partido
            $player = Games::create([
                'local_team_id' => $request->local_team_id,
                'away_team_id' => $request->away_team_id,
                'local_goals' => $request->local_goals,
                'away_goals' => $request->away_goals,
                'date'=> date("Y-m-d H:i:s")
            ]);

            /// Verificacamos el resultado del partido y procedemos a realizar la respectiva operación
            if($request->local_goals ==$request->away_goals ){
                /// Entra aqui si el partido quedo empatado

                /// Actualizamos el equipo local
                DB::table('classifications')
                ->where('team_id', $request->local_team_id)
                ->update([
                    'pj' => DB::raw('pj + 1'),
                    'pe' => DB::raw('pe + 1'),
                    'goals' => DB::raw('goals + '.$request->local_goals),
                    'points' => DB::raw('points + 1'),
                ]);
            }
          
            return response(
                [
                    'success' => true,
                    'messages' => ["Jugador creado con éxito."],
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
}
