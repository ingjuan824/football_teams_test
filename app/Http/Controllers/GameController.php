<?php

namespace App\Http\Controllers;

use App\Http\Requests\GameRequest;
use App\Models\Games;
use App\Models\Team;
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

            if ($request->local_team_id == $request->away_team_id)
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
            return back()->with('mensaje', 'Partido registrado con éxito.');
        } catch (\Exception $e) {
            return back()->withInput()->withErrors($e->getMessage());
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

    /**
     * Funcion que permite listar todos los partidos registrados en el sistema
     * @param $request['per_page'],Cantidad de registros por pagina
     */
    public function index()
    {
        try {
            $per_page = \Request::get('per_page') ?: 10;

            $teams = Team::get();
            $games = Games::select('games.*', 'tl.name as team_local', 'ta.name as team_away')
                ->join('teams as tl', 'tl.id', '=', 'games.local_team')
                ->join('teams as ta', 'ta.id', '=', 'games.away_team')
                ->paginate($per_page);
            return view('games')->with("teams", $teams)
                ->with("games", $games);
        } catch (\Exception $e) {
            return back()->withInput()->withErrors($e->getMessage());
        }
    }
}
